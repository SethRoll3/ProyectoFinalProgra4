package com.proyectofinal.importaciones;

import java.math.BigDecimal;

public record ProductoParaCatalogo(String codigo, String nombre, String categoria, BigDecimal precio, int existencia) {
    public ProductoParaCatalogo(FilaProducto fila) {
        this(fila.codigo(), fila.nombre(), fila.categoria(), fila.precio(), fila.existencia());
    }
}
