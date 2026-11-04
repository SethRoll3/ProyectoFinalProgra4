package com.proyectofinal.importaciones;

import io.swagger.v3.oas.annotations.OpenAPIDefinition;
import io.swagger.v3.oas.annotations.info.Info;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@OpenAPIDefinition(info = @Info(title = "API de importaciones", version = "1.0", description = "Carga e historial de productos CSV"))
@SpringBootApplication
public class ImportacionesApplication {
    public static void main(String[] args) {
        SpringApplication.run(ImportacionesApplication.class, args);
    }
}
