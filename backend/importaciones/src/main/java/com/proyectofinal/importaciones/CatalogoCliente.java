package com.proyectofinal.importaciones;

import java.util.List;

public interface CatalogoCliente {
    List<ResultadoCatalogo> crearLote(List<ProductoParaCatalogo> productos);
}
