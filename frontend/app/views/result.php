<p><a href="?page=historial">Volver al historial</a></p>
<h1>Resultado de importación</h1>
<dl>
    <dt>Archivo</dt><dd><?= e($result['archivo'] ?? '') ?></dd>
    <dt>Fecha</dt><dd><?= e($result['fecha'] ?? '') ?></dd>
    <dt>Estado</dt><dd><?= e($result['estado'] ?? '') ?></dd>
    <dt>Filas evaluadas</dt><dd><?= e($result['filas'] ?? 0) ?></dd>
    <dt>Aceptados</dt><dd><?= e($result['aceptados'] ?? 0) ?></dd>
    <dt>Rechazados</dt><dd><?= e($result['rechazados'] ?? 0) ?></dd>
</dl>
<h2>Errores por fila</h2>
<?php if (empty($result['errores'])): ?>
    <p>No hubo filas rechazadas.</p>
<?php else: ?>
    <table>
        <thead><tr><th>Fila</th><th>Código</th><th>Motivo</th></tr></thead>
        <tbody>
        <?php foreach ($result['errores'] as $item): ?>
            <tr>
                <td><?= e($item['fila'] ?? '') ?></td>
                <td><?= e($item['codigo'] ?? '') ?></td>
                <td><?= e($item['error'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<p><a href="?page=cargar">Importar otro archivo</a></p>
