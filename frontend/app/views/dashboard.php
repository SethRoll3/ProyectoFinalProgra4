<div class="page-intro"><div><span class="eyebrow">VISTA GENERAL</span><h1>Todo en orden,<br>en un solo lugar.</h1><p>Consulta tus productos y sigue cada archivo desde su llegada hasta el resultado.</p></div><a class="button button-primary" href="?page=cargar">Nueva importación <span aria-hidden="true">↗</span></a></div>
<?php if (isset($error)): ?>
    <p role="alert"><?= e($error) ?></p>
<?php endif; ?>
<section class="metrics" aria-label="Indicadores generales">
    <div class="metric-card"><span class="metric-label">PRODUCTOS EN CATÁLOGO</span><strong><?= $productCount === null ? '—' : e($productCount) ?></strong><span class="metric-caption">Disponibles para consulta <span aria-hidden="true">↗</span></span></div>
    <div class="metric-card"><span class="metric-label">ARCHIVOS PROCESADOS</span><strong><?= $importCount === null ? '—' : e($importCount) ?></strong><span class="metric-caption">Historial de cargas <span aria-hidden="true">↗</span></span></div>
    <div class="metric-card metric-card-accent"><span class="metric-label">SIGUIENTE PASO</span><strong class="metric-action">Importar CSV</strong><a href="?page=cargar">Cargar un archivo <span aria-hidden="true">→</span></a></div>
</section>
<section class="panel">
    <div class="section-head"><div><span class="eyebrow">MOVIMIENTO RECIENTE</span><h2>Últimas importaciones</h2></div><a class="text-link" href="?page=historial">Ver historial completo <span aria-hidden="true">→</span></a></div>
    <?php if ($recent === []): ?>
        <p>Aún no hay importaciones para mostrar.</p>
        <p><a href="?page=cargar">Cargar el primer archivo</a></p>
    <?php else: ?>
        <div class="table-wrap"><table>
            <thead><tr><th>Archivo</th><th>Fecha</th><th>Aceptados</th><th>Rechazados</th><th>Detalle</th></tr></thead>
            <tbody>
            <?php foreach ($recent as $item): ?>
                <tr>
                    <td><?= e($item['archivo'] ?? '') ?></td>
                    <td><?= e(displayDate($item['fecha'] ?? '')) ?></td>
                    <td><?= e($item['aceptados'] ?? 0) ?></td>
                    <td><?= e($item['rechazados'] ?? 0) ?></td>
                    <td><a href="?page=resultado&amp;id=<?= e($item['id'] ?? '') ?>">Ver resultado</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table></div>
    <?php endif; ?>
</section>
