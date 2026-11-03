package com.proyectofinal.catalogo;

import java.math.BigDecimal;

public record ProductoNuevo(String codigo, String nombre, String categoria, BigDecimal precio, Integer existencia) {
}
