package com.proyectofinal.importaciones;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;

@Entity
@Table(name = "importacion_error")
public class ImportacionError {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    @Column(name = "importacion_id")
    private Long importacionId;
    private int fila;
    private String codigo;
    @Column(length = 500)
    private String error;

    protected ImportacionError() {
    }

    public ImportacionError(Long importacionId, ErrorFila error) {
        this.importacionId = importacionId;
        this.fila = error.fila();
        this.codigo = error.codigo();
        this.error = error.error();
    }

    public ErrorFila comoErrorFila() {
        return new ErrorFila(fila, codigo, error);
    }
}
