# Backend

Aquí se desarrollarán `catalogo` e `importaciones` como microservicios Spring Boot. También se añadirán `gateway`, `eureka` y el script de MySQL en `database`.

Los CSV de ejemplo para importaciones están en `importaciones/csv/`. El primer avance del catálogo está en `catalogo/`.

Para compilar el catálogo se necesita JDK 21 y Maven. Crear la base y la tabla con `database/catalogo.sql`, configurar `DB_URL`, `DB_USER` y `DB_PASSWORD` si los valores locales no aplican, y ejecutar `mvn spring-boot:run` desde `backend/catalogo/`. La consulta inicial es `GET http://localhost:8081/api/productos`, con paginación mediante `page` y `size`.

Todavía faltan las operaciones de alta, categorías y las demás piezas del backend. Las instrucciones de arranque se ampliarán con cada componente.
