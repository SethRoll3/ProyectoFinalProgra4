package com.proyectofinal.importaciones;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import java.time.LocalDateTime;

@Entity
public class Importacion {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String archivo;
    private LocalDateTime fecha;
    private String estado;
    private int filas;
    private int aceptados;
    private int rechazados;

    protected Importacion() {
    }

    public Importacion(String archivo, LocalDateTime fecha, int filas, int aceptados, int rechazados) {
        this.archivo = archivo;
        this.fecha = fecha;
        this.estado = "COMPLETADA";
        this.filas = filas;
        this.aceptados = aceptados;
        this.rechazados = rechazados;
    }

    public Long getId() { return id; }
    public String getArchivo() { return archivo; }
    public LocalDateTime getFecha() { return fecha; }
    public String getEstado() { return estado; }
    public int getFilas() { return filas; }
    public int getAceptados() { return aceptados; }
    public int getRechazados() { return rechazados; }
}
