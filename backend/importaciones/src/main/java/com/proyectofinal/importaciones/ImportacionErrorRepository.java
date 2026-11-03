package com.proyectofinal.importaciones;

import java.util.List;
import org.springframework.data.jpa.repository.JpaRepository;

public interface ImportacionErrorRepository extends JpaRepository<ImportacionError, Long> {
    List<ImportacionError> findByImportacionIdOrderByFilaAsc(Long importacionId);
}
