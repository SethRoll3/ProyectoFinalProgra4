<div class="page-intro"><div><span class="eyebrow">TRAZABILIDAD</span><h1>Historial.</h1><p>Cada archivo conserva su fecha, balance y detalle de errores.</p></div><a class="button button-primary" href="?page=cargar">Nueva importación <span aria-hidden="true">↗</span></a></div>
<?php if (isset($error)): ?>
    <p role="alert"><?= e($error) ?></p>
<?php endif; ?>
<?php if (empty($history['content'])): ?>
    <p class="empty-state panel">Aún no hay importaciones para mostrar.</p>
    <p><a href="?page=cargar">Cargar un archivo</a></p>
<?php else: ?>
    <div class="panel table-wrap"><table>
        <thead><tr><th>Archivo</th><th>Fecha</th><th>Estado</th><th>Filas</th><th>Aceptados</th><th>Rechazados</th><th>Detalle</th></tr></thead>
        <tbody>
        <?php foreach ($history['content'] as $item): ?>
            <tr>
                <td><?= e($item['archivo'] ?? '') ?></td>
                <td><?= e(displayDate($item['fecha'] ?? '')) ?></td>
                <td><?= e($item['estado'] ?? '') ?></td>
                <td><?= e($item['filas'] ?? 0) ?></td>
                <td><?= e($item['aceptados'] ?? 0) ?></td>
                <td><?= e($item['rechazados'] ?? 0) ?></td>
                <td><a href="?page=resultado&amp;id=<?= e($item['id'] ?? '') ?>">Ver resultado</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
<?php endif; ?>
<?php $totalPages = (int) ($history['totalPages'] ?? 0); ?>
<?php if ($totalPages > 1): ?>
    <nav class="pagination" aria-label="Páginas del historial">
        <?php if ($currentPage > 1): ?><a href="?page=historial&amp;p=<?= e($currentPage - 1) ?>">Anterior</a><?php endif; ?>
        <span>Página <?= e($currentPage) ?> de <?= e($totalPages) ?></span>
        <?php if ($currentPage < $totalPages): ?><a href="?page=historial&amp;p=<?= e($currentPage + 1) ?>">Siguiente</a><?php endif; ?>
    </nav>
<?php endif; ?>
