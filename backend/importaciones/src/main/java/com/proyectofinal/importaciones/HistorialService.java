package com.proyectofinal.importaciones;

import java.time.LocalDateTime;
import java.util.List;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import org.springframework.web.server.ResponseStatusException;

@Service
public class HistorialService {
    private final ImportacionRepository importaciones;
    private final ImportacionErrorRepository errores;

    public HistorialService(ImportacionRepository importaciones, ImportacionErrorRepository errores) {
        this.importaciones = importaciones;
        this.errores = errores;
    }

    @Transactional
    public ResultadoImportacion guardar(String archivo, int filas, int aceptados, List<ErrorFila> erroresFila) {
        Importacion importacion = importaciones.save(new Importacion(archivo, LocalDateTime.now(), filas, aceptados, erroresFila.size()));
        errores.saveAll(erroresFila.stream().map(error -> new ImportacionError(importacion.getId(), error)).toList());
        return resultado(importacion, erroresFila);
    }

    public Page<Importacion> listar(Pageable pagina) {
        return importaciones.findAll(pagina);
    }

    public ResultadoImportacion detalle(Long id) {
        Importacion importacion = importaciones.findById(id)
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Importación no encontrada"));
        List<ErrorFila> erroresFila = errores.findByImportacionIdOrderByFilaAsc(id).stream()
                .map(ImportacionError::comoErrorFila).toList();
        return resultado(importacion, erroresFila);
    }

    private ResultadoImportacion resultado(Importacion importacion, List<ErrorFila> erroresFila) {
        return new ResultadoImportacion(importacion.getId(), importacion.getArchivo(), importacion.getFecha(),
                importacion.getEstado(), importacion.getFilas(), importacion.getAceptados(),
                importacion.getRechazados(), erroresFila);
    }
}
