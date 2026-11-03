package com.proyectofinal.catalogo;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ProductoRepository extends JpaRepository<Producto, Long> {
    boolean existsByCodigo(String codigo);

    Page<Producto> findByCodigoContainingIgnoreCaseAndNombreContainingIgnoreCaseAndCategoriaContainingIgnoreCase(
            String codigo, String nombre, String categoria, Pageable pageable);
}
