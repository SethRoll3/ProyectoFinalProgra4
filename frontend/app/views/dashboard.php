<h1>Resumen</h1>
<?php if (isset($error)): ?>
    <p role="alert"><?= e($error) ?></p>
<?php endif; ?>
<section aria-label="Indicadores generales">
    <h2>Estado del sistema</h2>
    <dl>
        <dt>Productos registrados</dt>
        <dd><?= $productCount === null ? 'No disponible' : e($productCount) ?></dd>
        <dt>Importaciones realizadas</dt>
        <dd><?= $importCount === null ? 'No disponible' : e($importCount) ?></dd>
    </dl>
</section>
<section>
    <h2>Importaciones recientes</h2>
    <?php if ($recent === []): ?>
        <p>Aún no hay importaciones para mostrar.</p>
        <p><a href="?page=cargar">Cargar el primer archivo</a></p>
    <?php else: ?>
        <table>
            <thead><tr><th>Archivo</th><th>Fecha</th><th>Aceptados</th><th>Rechazados</th><th>Detalle</th></tr></thead>
            <tbody>
            <?php foreach ($recent as $item): ?>
                <tr>
                    <td><?= e($item['archivo'] ?? '') ?></td>
                    <td><?= e($item['fecha'] ?? '') ?></td>
                    <td><?= e($item['aceptados'] ?? 0) ?></td>
                    <td><?= e($item['rechazados'] ?? 0) ?></td>
                    <td><a href="?page=resultado&amp;id=<?= e($item['id'] ?? '') ?>">Ver resultado</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
