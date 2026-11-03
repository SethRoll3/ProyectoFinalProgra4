package com.proyectofinal.importaciones;

import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UncheckedIOException;
import java.nio.charset.CodingErrorAction;
import java.nio.charset.StandardCharsets;
import java.util.List;
import java.util.Locale;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVRecord;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.multipart.MultipartFile;
import org.springframework.web.server.ResponseStatusException;

@Service
public class CsvService {
    private static final List<String> ENCABEZADOS = List.of("codigo", "nombre", "categoria", "precio", "existencia");

    public ValidacionCsv validar(MultipartFile archivo) {
        if (archivo == null || archivo.isEmpty()) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El archivo está vacío");
        }

        String nombre = archivo.getOriginalFilename();
        if (nombre == null || !nombre.toLowerCase(Locale.ROOT).endsWith(".csv")) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El archivo debe tener extensión .csv");
        }

        var decodificador = StandardCharsets.UTF_8.newDecoder()
                .onMalformedInput(CodingErrorAction.REPORT)
                .onUnmappableCharacter(CodingErrorAction.REPORT);
        try (var lector = new InputStreamReader(archivo.getInputStream(), decodificador);
             CSVParser csv = CSVFormat.DEFAULT.builder().setIgnoreEmptyLines(false).get().parse(lector)) {
            List<CSVRecord> filas = csv.getRecords();
            if (filas.isEmpty()) {
                throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El archivo está vacío");
            }
            if (!filas.getFirst().toList().equals(ENCABEZADOS)) {
                throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "Los encabezados deben ser codigo,nombre,categoria,precio,existencia");
            }
            if (filas.size() == 1) {
                throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El archivo no contiene productos");
            }
            for (int i = 1; i < filas.size(); i++) {
                if (filas.get(i).size() != ENCABEZADOS.size()) {
                    throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "La fila " + (i + 1) + " debe tener cinco columnas");
                }
            }
            return new ValidacionCsv(nombre, filas.size() - 1);
        } catch (IOException | UncheckedIOException error) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "No se pudo leer el CSV en UTF-8", error);
        }
    }
}
