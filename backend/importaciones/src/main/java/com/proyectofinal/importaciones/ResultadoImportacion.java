package com.proyectofinal.importaciones;

import java.util.List;

public record ResultadoImportacion(String archivo, int filas, int aceptados, int rechazados, List<ErrorFila> errores) {
}
