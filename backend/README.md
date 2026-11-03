# Backend

Aquí se desarrollarán `catalogo` e `importaciones` como microservicios Spring Boot. También se añadirán `gateway`, `eureka` y el script de MySQL en `database`.

Los CSV de ejemplo para importaciones están en `importaciones/csv/`. El primer avance del catálogo está en `catalogo/`.

Para compilar el catálogo se necesita JDK 21 y Maven. Crear la base y las tablas con `database/catalogo.sql`, configurar `DB_URL`, `DB_USER` y `DB_PASSWORD` si los valores locales no aplican, y ejecutar `mvn spring-boot:run` desde `backend/catalogo/`. Los endpoints disponibles son `GET /api/categorias`, `GET /api/productos` con paginación mediante `page` y `size`, y `POST /api/productos`. El alta recibe `codigo`, `nombre`, `categoria`, `precio` y `existencia` en JSON; devuelve 201 si crea el producto, 400 si los datos son inválidos y 409 si el código ya existe. Los rechazos incluyen un campo `error` con el motivo.

Todavía faltan el registro por lote, los filtros y las demás piezas del backend. Las instrucciones de arranque se ampliarán con cada componente.
