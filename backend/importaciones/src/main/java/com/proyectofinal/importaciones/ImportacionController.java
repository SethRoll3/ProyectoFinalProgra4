package com.proyectofinal.importaciones;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestPart;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/importaciones")
public class ImportacionController {
    private final ImportacionService service;

    public ImportacionController(ImportacionService service) {
        this.service = service;
    }

    @PostMapping
    public ResultadoImportacion importar(@RequestPart("archivo") MultipartFile archivo) {
        return service.importar(archivo);
    }
}
