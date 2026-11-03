package com.proyectofinal.importaciones;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestPart;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/importaciones/validaciones")
public class ValidacionController {
    private final CsvService csvService;

    public ValidacionController(CsvService csvService) {
        this.csvService = csvService;
    }

    @PostMapping
    public ValidacionCsv validar(@RequestPart("archivo") MultipartFile archivo) {
        return csvService.validar(archivo);
    }
}
