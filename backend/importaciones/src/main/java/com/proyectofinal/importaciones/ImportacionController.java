package com.proyectofinal.importaciones;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Sort;
import org.springframework.data.web.PageableDefault;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestPart;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/importaciones")
public class ImportacionController {
    private final ImportacionService service;
    private final HistorialService historial;

    public ImportacionController(ImportacionService service, HistorialService historial) {
        this.service = service;
        this.historial = historial;
    }

    @PostMapping
    public ResultadoImportacion importar(@RequestPart("archivo") MultipartFile archivo) {
        return service.importar(archivo);
    }

    @GetMapping
    public Page<Importacion> listar(@PageableDefault(sort = "fecha", direction = Sort.Direction.DESC) Pageable pagina) {
        return historial.listar(pagina);
    }

    @GetMapping("/{id}")
    public ResultadoImportacion detalle(@PathVariable Long id) {
        return historial.detalle(id);
    }
}
