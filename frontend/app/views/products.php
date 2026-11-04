<div class="page-intro"><div><span class="eyebrow">CATÁLOGO ACTIVO</span><h1>Productos.</h1><p>Encuentra cada producto por código, nombre o categoría.</p></div><a class="button button-primary" href="?page=cargar">Añadir con CSV <span aria-hidden="true">↗</span></a></div>
<?php if (isset($error)): ?>
    <p class="alert" role="alert"><?= e($error) ?></p>
<?php endif; ?>
<form class="filter-bar panel" method="get">
    <input type="hidden" name="page" value="productos">
    <div class="field"><label for="codigo">Código</label><input id="codigo" name="codigo" placeholder="Ej. P001" value="<?= e($filters['codigo']) ?>"></div>
    <div class="field"><label for="nombre">Nombre</label><input id="nombre" name="nombre" placeholder="Buscar producto" value="<?= e($filters['nombre']) ?>"></div>
    <div class="field"><label for="categoria">Categoría</label><select id="categoria" name="categoria">
        <option value="">Todas</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= e($category['nombre'] ?? '') ?>" <?= ($filters['categoria'] === ($category['nombre'] ?? '')) ? 'selected' : '' ?>><?= e($category['nombre'] ?? '') ?></option>
        <?php endforeach; ?>
    </select></div>
    <div class="filter-actions"><button class="button button-dark" type="submit">Buscar <span aria-hidden="true">→</span></button><a class="text-link" href="?page=productos">Limpiar</a></div>
</form>
<div class="section-head list-head"><div><span class="eyebrow">RESULTADOS</span><h2><?= e($products['totalElements'] ?? 0) ?> productos encontrados</h2></div></div>
<?php if (empty($products['content'])): ?>
    <p class="empty-state panel">No se encontraron productos con estos filtros. Prueba con otro código, nombre o categoría.</p>
<?php else: ?>
    <div class="panel table-wrap"><table>
        <thead><tr><th>Código</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Existencia</th><th>Detalle</th></tr></thead>
        <tbody>
        <?php foreach ($products['content'] as $product): ?>
            <tr>
                <td><?= e($product['codigo'] ?? '') ?></td>
                <td><?= e($product['nombre'] ?? '') ?></td>
                <td><?= e($product['categoria'] ?? '') ?></td>
                <td>Q <?= e(number_format((float) ($product['precio'] ?? 0), 2)) ?></td>
                <td><?= e($product['existencia'] ?? 0) ?></td>
                <td><a href="?page=producto&amp;id=<?= e($product['id'] ?? '') ?>">Ver</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table></div>
<?php endif; ?>
<?php $totalPages = (int) ($products['totalPages'] ?? 0); ?>
<?php if ($totalPages > 1): ?>
    <form class="pagination" method="get" aria-label="Páginas de productos">
        <input type="hidden" name="page" value="productos">
        <?php if ($currentPage > 1): ?>
            <button type="submit" name="p" value="<?= e($currentPage - 1) ?>">Anterior</button>
        <?php endif; ?>
        <span>Página <?= e($currentPage) ?> de <?= e($totalPages) ?></span>
        <?php if ($currentPage < $totalPages): ?>
            <button type="submit" name="p" value="<?= e($currentPage + 1) ?>">Siguiente</button>
        <?php endif; ?>
    </form>
<?php endif; ?>
