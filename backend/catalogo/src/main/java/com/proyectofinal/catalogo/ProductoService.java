package com.proyectofinal.catalogo;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.dao.DataIntegrityViolationException;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

@Service
public class ProductoService {
    private static final Logger log = LoggerFactory.getLogger(ProductoService.class);
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
            Producto producto = productos.saveAndFlush(new Producto(codigo, nombre, categoria, datos.precio(), datos.existencia()));
            log.info("Producto creado: código={}, id={}", producto.getCodigo(), producto.getId());
            return producto;
        } catch (DataIntegrityViolationException error) {
            throw new ResponseStatusException(HttpStatus.CONFLICT, "El código ya existe", error);
        }
    }

    public List<ResultadoProducto> crearLote(List<ProductoNuevo> datos) {
        if (datos == null || datos.isEmpty()) {
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "El lote debe contener productos");
        }

        List<ResultadoProducto> resultados = new ArrayList<>();
        for (int indice = 0; indice < datos.size(); indice++) {
            ProductoNuevo entrada = datos.get(indice);
            String codigo = entrada == null ? null : entrada.codigo();
            try {
                Producto producto = crear(entrada);
                resultados.add(new ResultadoProducto(indice, producto.getCodigo(), true, producto.getId(), null));
            } catch (ResponseStatusException error) {
                log.warn("Producto rechazado en posición {}: código={}, motivo={}", indice, codigo, error.getReason());
                resultados.add(new ResultadoProducto(indice, codigo, false, null, error.getReason()));
            }
        }
        return resultados;
    }

    private boolean vacio(String valor) {
        return valor == null || valor.isBlank();
    }
}
