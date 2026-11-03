# Frontend PHP MVC

El punto de entrada es `public/index.php`. Los controladores en `app/` preparan los datos, `GatewayClient.php` consulta el backend únicamente mediante Gateway y las vistas en `app/views/` generan HTML. PHP no accede a MySQL.

Esta primera etapa incluye resumen, carga de CSV, resultado, catálogo con filtros y paginación, detalle de producto e historial. Las vistas todavía no tienen CSS ni JavaScript.

## Ejecutar en Windows

1. Encender MySQL en XAMPP e iniciar Eureka, catálogo, importaciones y Gateway según `backend/README.md`.
2. Abrir PowerShell en la carpeta `frontend` del repositorio.
3. Ejecutar `& 'C:\xampp\php\php.exe' -S 127.0.0.1:8000 -t public`.
4. Abrir `http://127.0.0.1:8000/` en el navegador. Para detener PHP, pulsar `Ctrl+C` en esa ventana.

Gateway debe estar en `http://localhost:8080`. Si usa otra dirección, establecer la variable de entorno `GATEWAY_URL` antes de iniciar PHP.
