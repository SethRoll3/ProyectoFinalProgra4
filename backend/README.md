# Backend

Aquí se desarrollarán `catalogo` e `importaciones` como microservicios Spring Boot. También se añadirán `gateway`, `eureka` y el script de MySQL en `database`.

Los CSV de ejemplo para importaciones están en `importaciones/csv/`. El primer avance del catálogo está en `catalogo/`.

Para compilar el catálogo se necesita JDK 21 y Maven. Crear la base y las tablas con `database/catalogo.sql`, configurar `DB_URL`, `DB_USER` y `DB_PASSWORD` si los valores locales no aplican, y ejecutar `mvn spring-boot:run` desde `backend/catalogo/`. Los endpoints disponibles son `GET /api/categorias`, `GET /api/productos`, `GET /api/productos/{id}`, `POST /api/productos` y `POST /api/productos/lotes`. El listado acepta `page`, `size` y filtros opcionales `codigo`, `nombre` y `categoria`, que se pueden combinar. El alta recibe `codigo`, `nombre`, `categoria`, `precio` y `existencia` en JSON; devuelve 201 si crea el producto, 400 si los datos son inválidos y 409 si el código ya existe. Los rechazos incluyen un campo `error` con el motivo. El alta por lote recibe un arreglo de esos productos y devuelve un resultado por posición con `indice` iniciado en cero, `codigo`, `aceptado`, `productoId` y `error`. El servicio de importaciones podrá convertir cada índice a su número de fila en el CSV.

Todavía faltan el microservicio de importaciones, Eureka, Gateway y las demás piezas del backend. Las instrucciones de arranque se ampliarán con cada componente.

El catálogo publica su especificación OpenAPI en `http://localhost:8081/v3/api-docs` y la interfaz Swagger en `http://localhost:8081/swagger-ui/index.html`. Los eventos de creación y rechazo aparecen en la salida de consola mediante Logback.
