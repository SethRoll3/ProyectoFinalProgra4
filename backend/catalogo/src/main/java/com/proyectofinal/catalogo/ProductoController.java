package com.proyectofinal.catalogo;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
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
    public Page<Producto> listar(Pageable pageable) {
        return repository.findAll(pageable);
    }

    @PostMapping
    @ResponseStatus(HttpStatus.CREATED)
    public Producto crear(@RequestBody ProductoNuevo datos) {
        return service.crear(datos);
    }
}
