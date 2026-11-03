<h1>Productos</h1>
<?php if (isset($error)): ?>
    <p role="alert"><?= e($error) ?></p>
<?php endif; ?>
<form method="get">
    <input type="hidden" name="page" value="productos">
    <label for="codigo">Código</label>
    <input id="codigo" name="codigo" value="<?= e($filters['codigo']) ?>">
    <label for="nombre">Nombre</label>
    <input id="nombre" name="nombre" value="<?= e($filters['nombre']) ?>">
    <label for="categoria">Categoría</label>
    <select id="categoria" name="categoria">
        <option value="">Todas</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= e($category['nombre'] ?? '') ?>" <?= ($filters['categoria'] === ($category['nombre'] ?? '')) ? 'selected' : '' ?>><?= e($category['nombre'] ?? '') ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Buscar productos</button>
    <a href="?page=productos">Limpiar filtros</a>
</form>
<p><?= e($products['totalElements'] ?? 0) ?> productos encontrados</p>
<?php if (empty($products['content'])): ?>
    <p>No se encontraron productos con estos filtros.</p>
<?php else: ?>
    <table>
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
    </table>
<?php endif; ?>
<?php $totalPages = (int) ($products['totalPages'] ?? 0); ?>
<?php if ($totalPages > 1): ?>
    <nav aria-label="Páginas de productos">
        <?php if ($currentPage > 1): ?>
            <a href="?<?= e(http_build_query(['page' => 'productos'] + $filters + ['p' => $currentPage - 1])) ?>">Anterior</a>
        <?php endif; ?>
        <span>Página <?= e($currentPage) ?> de <?= e($totalPages) ?></span>
        <?php if ($currentPage < $totalPages): ?>
            <a href="?<?= e(http_build_query(['page' => 'productos'] + $filters + ['p' => $currentPage + 1])) ?>">Siguiente</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>
