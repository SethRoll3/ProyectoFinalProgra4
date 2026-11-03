# Gestión de importación de productos

Proyecto de práctica basado en la especificación de Programación IV. Permitirá cargar productos desde CSV, revisar cada importación y consultar el catálogo.

## Componentes previstos

| Carpeta | Responsabilidad |
| --- | --- |
| `backend/catalogo/` | Spring Boot: productos y categorías; administra sus tablas MySQL. |
| `backend/importaciones/` | Spring Boot: recibe CSV, coordina el registro y guarda historial y errores. |
| `backend/eureka/` | Registro y descubrimiento de servicios. |
| `backend/gateway/` | Entrada HTTP para el frontend. |
| `backend/database/` | Script de creación de bases de datos. |
| `frontend/` | PHP MVC; consume el backend mediante Gateway. |

Cada servicio administrará sus propias tablas. Importaciones enviará productos al catálogo por HTTP, localizándolo mediante Eureka. El catálogo responderá por producto si fue aceptado o rechazado y por qué. PHP no accederá directamente a MySQL.

## Contrato inicial del CSV

UTF-8, separador coma y encabezados en este orden exacto:

```csv
codigo,nombre,categoria,precio,existencia
```

`codigo`, `nombre` y `categoria` son obligatorios; `precio` debe ser mayor que cero y `existencia` un entero no negativo. Los errores conservarán el número de fila. Hay ejemplos en `backend/importaciones/csv/`.

## Avance progresivo

1. Estructura, contratos y datos de ejemplo.
2. Catálogo: categorías, productos, validaciones y registro por lote.
3. Importaciones: CSV, llamada al catálogo e historial.
4. Eureka y Gateway: demostrar las rutas entre servicios.
5. Frontend PHP MVC; acordar después el diseño visual.
6. Documentación de ejecución, OpenAPI y casos de prueba.

Cada etapa se desarrollará en cambios pequeños y comprobables. Todavía no hay servicios ejecutables; las instrucciones de arranque se añadirán con cada componente.
