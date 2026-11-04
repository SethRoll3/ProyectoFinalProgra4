package com.proyectofinal.importaciones;

import java.util.List;
import java.time.LocalDateTime;

public record ResultadoImportacion(Long id, String archivo, LocalDateTime fecha, String estado, int filas,
                                   int aceptados, int rechazados, List<ErrorFila> errores) {
}
