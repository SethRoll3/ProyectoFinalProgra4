# Backend

El `pom.xml` de la raíz reúne Eureka, catálogo, importaciones y Gateway en un proyecto Maven con JDK 21. `mvn package` desde la raíz compila los cuatro módulos. Cada microservicio se ejecuta en su propio proceso.

## Preparación en Windows

1. Instalar JDK 21 y Maven. Si se usa la instalación preparada en esta computadora, JDK está en `C:\Program Files\Java\jdk-21.0.12` y Maven en `C:\Users\Boteo\.codex\tools\apache-maven-3.10.0`.
2. Encender MySQL en XAMPP. En esta computadora escucha en el puerto `3306`.
3. En phpMyAdmin, abrir **Importar** y cargar `backend/database/catalogo.sql`. Repetir con `backend/database/importaciones.sql`. Ambos scripts crean sus bases y tablas si no existen.
4. Abrir PowerShell en la raíz del repositorio y ejecutar:

```powershell
$env:JAVA_HOME = 'C:\Program Files\Java\jdk-21.0.12'
& 'C:\Users\Boteo\.codex\tools\apache-maven-3.10.0\bin\mvn.cmd' package
```

Si JDK o Maven están instalados en otra ruta, ajustar esas rutas. El catálogo usa `DB_URL`, `DB_USER` y `DB_PASSWORD`; importaciones usa `IMPORTACIONES_DB_URL`, `DB_USER` y `DB_PASSWORD`. Los valores predeterminados apuntan a `localhost:3306` con usuario `root` y contraseña vacía.

Catálogo e importaciones se anuncian en Eureka como `localhost` para que Gateway los encuentre en esta computadora. Si se ejecutan en equipos distintos, establecer `EUREKA_INSTANCE_HOSTNAME` en cada servicio con un nombre accesible desde Gateway.

## Ejecución

Después de compilar, iniciar los JAR en este orden, cada uno en su propia ventana de PowerShell:

| Servicio | Comando desde la raíz | Puerto |
| --- | --- | --- |
| Eureka | `java -jar backend/eureka/target/eureka-0.1.0.jar` | 8761 |
| Catálogo | `java -jar backend/catalogo/target/catalogo-0.1.0.jar` | 8081 |
| Importaciones | `java -jar backend/importaciones/target/importaciones-0.1.0.jar` | 8082 |
| Gateway | `java -jar backend/gateway/target/gateway-0.1.0.jar` | 8080 |

En cada ventana debe estar seleccionado JDK 21. Se puede usar `& 'C:\Program Files\Java\jdk-21.0.12\bin\java.exe'` en lugar de `java` si el comando global utiliza otra versión. `Ctrl+C` detiene el servicio de esa ventana. El panel `http://localhost:8761/` muestra los servicios registrados.

## API

PHP debe llamar a Gateway en `http://localhost:8080`, que localiza los servicios mediante Eureka. Gateway conserva las rutas originales:

| Ruta | Servicio |
| --- | --- |
| `/api/categorias` y `/api/productos/**` | Catálogo |
| `/api/importaciones/**` | Importaciones |

Catálogo ofrece consulta de categorías, búsqueda y paginación de productos, detalle y altas individuales o por lote. Importaciones ofrece `POST /api/importaciones` con formulario multipart y campo `archivo`, `GET /api/importaciones` para el historial paginado y `GET /api/importaciones/{id}` para el resumen y los errores. `POST /api/importaciones/validaciones` comprueba la estructura del CSV y `POST /api/importaciones/analisis` muestra las filas interpretadas sin registrar productos.

Los CSV deben ser UTF-8, separados por comas y comenzar exactamente con `codigo,nombre,categoria,precio,existencia`. Hay ejemplos en `backend/importaciones/csv/`. Importaciones separa los errores de formato, envía el resto al catálogo por HTTP usando Eureka y guarda el resumen y los rechazos en la base `importaciones`. Solo catálogo modifica sus tablas de productos.

Swagger está disponible en `http://localhost:8081/swagger-ui/index.html` para catálogo y `http://localhost:8082/swagger-ui/index.html` para importaciones. Sus especificaciones JSON están en `/v3/api-docs` de cada servicio. Ambos servicios registran eventos en consola mediante Logback.
