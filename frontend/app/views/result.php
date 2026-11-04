<p class="back-link"><a href="?page=historial">← Volver al historial</a></p>
<div class="page-intro result-intro"><div><span class="eyebrow">RESULTADO DE IMPORTACIÓN / #<?= e($result['id'] ?? '') ?></span><h1>Así terminó la carga.</h1><p>Consulta el balance del archivo y revisa las filas que necesitan atención.</p></div><a class="button button-primary" href="?page=cargar">Importar otro archivo <span aria-hidden="true">↗</span></a></div>
<section class="result-file panel" aria-label="Archivo importado">
    <div class="result-file-icon" aria-hidden="true">↓</div>
    <div class="result-file-info"><span class="eyebrow">ARCHIVO PROCESADO</span><h2><?= e($result['archivo'] ?? '') ?></h2><p><?= e(displayDate($result['fecha'] ?? '')) ?></p></div>
    <span class="result-status"><?= e($result['estado'] ?? '') ?></span>
</section>
<section class="result-cards" aria-label="Resumen de la importación">
    <div class="result-card"><span class="eyebrow">FILAS EVALUADAS</span><strong><?= e($result['filas'] ?? 0) ?></strong><span>registros en el archivo</span></div>
    <div class="result-card result-card-success"><span class="eyebrow">ACEPTADOS</span><strong><?= e($result['aceptados'] ?? 0) ?></strong><span>productos incorporados</span></div>
    <div class="result-card result-card-error"><span class="eyebrow">RECHAZADOS</span><strong><?= e($result['rechazados'] ?? 0) ?></strong><span>filas para revisar</span></div>
</section>
<section class="panel result-errors"><div class="section-head"><div><span class="eyebrow">REVISIÓN DE FILAS</span><h2>Errores por fila</h2></div><span class="file-pill"><?= e($result['rechazados'] ?? 0) ?> rechazados</span></div>
<?php if (empty($result['errores'])): ?>
    <p class="empty-state">No hubo filas rechazadas. Todos los registros se incorporaron correctamente.</p>
<?php else: ?>
    <div class="table-wrap"><table>
        <thead><tr><th>Fila</th><th>Código</th><th>Motivo</th></tr></thead>
        <tbody>
        <?php foreach ($result['errores'] as $item): ?>
            <tr>
                <td><span class="row-number"><?= e($item['fila'] ?? '') ?></span></td>
                <td><?= e($item['codigo'] ?? '') ?></td>
                <td><?= e($item['error'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
<?php endif; ?>
</section>
