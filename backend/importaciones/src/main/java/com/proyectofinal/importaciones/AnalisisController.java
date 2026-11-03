package com.proyectofinal.importaciones;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestPart;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/importaciones/analisis")
public class AnalisisController {
    private final CsvService csvService;

    public AnalisisController(CsvService csvService) {
        this.csvService = csvService;
    }

    @PostMapping
    public AnalisisCsv analizar(@RequestPart("archivo") MultipartFile archivo) {
        return csvService.analizar(archivo);
    }
}
