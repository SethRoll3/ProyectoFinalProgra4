<p class="back-link"><a href="?page=historial">← Volver al historial</a></p>
<div class="page-intro"><div><span class="eyebrow">IMPORTACIÓN #<?= e($result['id'] ?? '') ?></span><h1>Resultado del archivo.</h1><p>Revisa el balance de la carga y los registros que requieren atención.</p></div><a class="button button-primary" href="?page=cargar">Importar otro archivo <span aria-hidden="true">↗</span></a></div>
<dl class="result-summary panel">
    <dt>Archivo</dt><dd><?= e($result['archivo'] ?? '') ?></dd>
    <dt>Fecha</dt><dd><?= e(displayDate($result['fecha'] ?? '')) ?></dd>
    <dt>Estado</dt><dd><?= e($result['estado'] ?? '') ?></dd>
    <dt>Filas evaluadas</dt><dd><?= e($result['filas'] ?? 0) ?></dd>
    <dt>Aceptados</dt><dd><?= e($result['aceptados'] ?? 0) ?></dd>
    <dt>Rechazados</dt><dd><?= e($result['rechazados'] ?? 0) ?></dd>
</dl>
<section class="panel"><div class="section-head"><div><span class="eyebrow">REVISIÓN DE FILAS</span><h2>Errores por fila</h2></div><span class="file-pill"><?= e($result['rechazados'] ?? 0) ?> rechazados</span></div>
<?php if (empty($result['errores'])): ?>
    <p class="empty-state">No hubo filas rechazadas. Todos los registros se incorporaron correctamente.</p>
<?php else: ?>
    <div class="table-wrap"><table>
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
    </table></div>
<?php endif; ?>
</section>
