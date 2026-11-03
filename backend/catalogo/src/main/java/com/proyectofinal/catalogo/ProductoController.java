package com.proyectofinal.catalogo;

import java.util.List;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.HttpStatus;
import org.springframework.web.server.ResponseStatusException;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.ResponseStatus;

@RestController
@RequestMapping("/api/productos")
public class ProductoController {
    private final ProductoRepository repository;
    private final ProductoService service;

    public ProductoController(ProductoRepository repository, ProductoService service) {
        this.repository = repository;
        this.service = service;
    }

    @GetMapping
    public Page<Producto> listar(
            @RequestParam(defaultValue = "") String codigo,
            @RequestParam(defaultValue = "") String nombre,
            @RequestParam(defaultValue = "") String categoria,
            Pageable pageable) {
        return repository.findByCodigoContainingIgnoreCaseAndNombreContainingIgnoreCaseAndCategoriaContainingIgnoreCase(
                codigo.trim(), nombre.trim(), categoria.trim(), pageable);
    }

    @GetMapping("/{id}")
    public Producto detalle(@PathVariable Long id) {
        return repository.findById(id)
                .orElseThrow(() -> new ResponseStatusException(HttpStatus.NOT_FOUND, "Producto no encontrado"));
    }

    @PostMapping
    @ResponseStatus(HttpStatus.CREATED)
    public Producto crear(@RequestBody ProductoNuevo datos) {
        return service.crear(datos);
    }

    @PostMapping("/lotes")
    public List<ResultadoProducto> crearLote(@RequestBody List<ProductoNuevo> datos) {
        return service.crearLote(datos);
    }
}
