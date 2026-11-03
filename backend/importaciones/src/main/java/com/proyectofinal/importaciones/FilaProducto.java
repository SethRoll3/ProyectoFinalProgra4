package com.proyectofinal.importaciones;

import java.math.BigDecimal;

public record FilaProducto(int fila, String codigo, String nombre, String categoria, BigDecimal precio, int existencia) {
}
