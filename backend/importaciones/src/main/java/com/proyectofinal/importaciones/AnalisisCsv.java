package com.proyectofinal.importaciones;

import java.util.List;

public record AnalisisCsv(String archivo, int filas, List<FilaProducto> validas, List<ErrorFila> errores) {
}
