package com.proyectofinal.catalogo;

import java.util.Map;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.RestControllerAdvice;
import org.springframework.web.server.ResponseStatusException;

@RestControllerAdvice
public class ErrorController {
    private static final Logger log = LoggerFactory.getLogger(ErrorController.class);

    @ExceptionHandler(ResponseStatusException.class)
    public ResponseEntity<Map<String, String>> responder(ResponseStatusException error) {
        log.warn("Solicitud rechazada: estado={}, motivo={}", error.getStatusCode().value(), error.getReason());
        return ResponseEntity.status(error.getStatusCode()).body(Map.of("error", error.getReason()));
    }
}
