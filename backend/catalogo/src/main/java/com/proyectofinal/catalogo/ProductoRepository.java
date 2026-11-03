package com.proyectofinal.catalogo;

import org.springframework.data.jpa.repository.JpaRepository;

public interface ProductoRepository extends JpaRepository<Producto, Long> {
    boolean existsByCodigo(String codigo);
}
