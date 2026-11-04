# Frontend PHP MVC

El punto de entrada es `public/index.php`. Los controladores en `app/` preparan los datos, `GatewayClient.php` consulta el backend únicamente mediante Gateway y las vistas en `app/views/` generan HTML. PHP no accede a MySQL.

El frontend incluye resumen, carga de CSV, resultado, catálogo con filtros y paginación, detalle de producto e historial. El diseño está en `public/assets/styles.css` y usa Flexbox y animaciones CSS, sin JavaScript. Los componentes visuales adaptados de Uiverse y sus créditos están en `THIRD_PARTY_LICENSES.md`.

Durante el envío de un CSV válido se muestra un camión animado mientras el navegador espera la respuesta. Al completar la petición, PHP redirige a la página del resultado. Las animaciones respetan la preferencia de movimiento reducido del sistema.

## Ejecutar en Windows

1. Encender MySQL en XAMPP e iniciar Eureka, catálogo, importaciones y Gateway según `backend/README.md`.
2. Abrir PowerShell en la carpeta `frontend` del repositorio.
3. Ejecutar `& 'C:\xampp\php\php.exe' -S 127.0.0.1:8000 -t public`.
4. Abrir `http://127.0.0.1:8000/` en el navegador. Para detener PHP, pulsar `Ctrl+C` en esa ventana.

Gateway debe estar en `http://localhost:8080`. Si usa otra dirección, establecer la variable de entorno `GATEWAY_URL` antes de iniciar PHP.
