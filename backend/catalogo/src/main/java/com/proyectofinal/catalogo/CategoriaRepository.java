package com.proyectofinal.catalogo;

import java.util.Optional;
import org.springframework.data.jpa.repository.JpaRepository;

public interface CategoriaRepository extends JpaRepository<Categoria, Long> {
    Optional<Categoria> findByNombreIgnoreCase(String nombre);
}
