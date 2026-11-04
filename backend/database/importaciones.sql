CREATE DATABASE IF NOT EXISTS importaciones CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE importaciones;

CREATE TABLE IF NOT EXISTS importacion (
    id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    archivo VARCHAR(255) NOT NULL,
    fecha DATETIME(6) NOT NULL,
    estado VARCHAR(30) NOT NULL,
    filas INT NOT NULL,
    aceptados INT NOT NULL,
    rechazados INT NOT NULL
);

CREATE TABLE IF NOT EXISTS importacion_error (
    id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    importacion_id BIGINT NOT NULL,
    fila INT NOT NULL,
    codigo VARCHAR(255),
    error VARCHAR(500) NOT NULL,
    CONSTRAINT fk_importacion_error_importacion FOREIGN KEY (importacion_id) REFERENCES importacion(id)
);
