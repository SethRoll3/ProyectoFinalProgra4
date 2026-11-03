package com.proyectofinal.catalogo;

import java.math.BigDecimal;
import org.springframework.dao.DataIntegrityViolationException;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

@Service
public class ProductoService {
    private final ProductoRepository productos;
    private final CategoriaRepository categorias;

    public ProductoService(ProductoRepository productos, CategoriaRepository categorias) {
        this.productos = productos;
        this.categorias = categorias;
    }

    public Producto crear(ProductoNuevo datos) {
        if (datos == null || vacio(datos.codigo()) || vacio(datos.nombre()) || vacio(datos.categoria())) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "Código, nombre y categoría son obligatorios");
        }
        if (datos.precio() == null || datos.precio().compareTo(BigDecimal.ZERO) <= 0) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El precio debe ser mayor que cero");
        }
        if (datos.existencia() == null || datos.existencia() < 0) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "La existencia debe ser un entero no negativo");
        }

        String codigo = datos.codigo().trim();
        String nombre = datos.nombre().trim();
        String categoria = categorias.findByNombreIgnoreCase(datos.categoria().trim())
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.BAD_REQUEST, "La categoría no existe"))
                .getNombre();

        if (productos.existsByCodigo(codigo)) {
            throw new ResponseStatusException(HttpStatus.CONFLICT, "El código ya existe");
        }

        try {
            return productos.saveAndFlush(new Producto(codigo, nombre, categoria, datos.precio(), datos.existencia()));
        } catch (DataIntegrityViolationException error) {
            throw new ResponseStatusException(HttpStatus.CONFLICT, "El código ya existe", error);
        }
    }

    private boolean vacio(String valor) {
        return valor == null || valor.isBlank();
    }
}
