package com.proyectofinal.importaciones;

import java.util.ArrayList;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.server.ResponseStatusException;

@Service
public class ImportacionService {
    private final CsvService csvService;
    private final CatalogoCliente catalogo;

    public ImportacionService(CsvService csvService, CatalogoCliente catalogo) {
        this.csvService = csvService;
        this.catalogo = catalogo;
    }

    public ResultadoImportacion importar(MultipartFile archivo) {
        AnalisisCsv analisis = csvService.analizar(archivo);
        var errores = new ArrayList<>(analisis.errores());
        int aceptados = 0;
        if (!analisis.validas().isEmpty()) {
            var productos = analisis.validas().stream().map(ProductoParaCatalogo::new).toList();
            var resultados = catalogo.crearLote(productos);
            for (int i = 0; i < resultados.size(); i++) {
                ResultadoCatalogo resultado = resultados.get(i);
                if (resultado.indice() != i) {
                    throw new ResponseStatusException(HttpStatus.BAD_GATEWAY, "El catálogo devolvió posiciones incorrectas");
                }
                if (resultado.aceptado()) {
                    aceptados++;
                } else {
                    FilaProducto fila = analisis.validas().get(i);
                    errores.add(new ErrorFila(fila.fila(), fila.codigo(), resultado.error()));
                }
            }
        }
        errores.sort((a, b) -> Integer.compare(a.fila(), b.fila()));
        return new ResultadoImportacion(analisis.archivo(), analisis.filas(), aceptados, errores.size(), errores);
    }
}
