package com.proyectofinal.catalogo;

import java.util.Map;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;
import org.springframework.web.server.ResponseStatusException;

@RestControllerAdvice
public class ErrorController {
    @ExceptionHandler(ResponseStatusException.class)
    public ResponseEntity<Map<String, String>> responder(ResponseStatusException error) {
        return ResponseEntity.status(error.getStatusCode()).body(Map.of("error", error.getReason()));
    }
}
