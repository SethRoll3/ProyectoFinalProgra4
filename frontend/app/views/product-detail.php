<p><a href="?page=productos">Volver a productos</a></p>
<h1><?= e($product['nombre'] ?? 'Producto') ?></h1>
<dl>
    <dt>Identificador</dt><dd><?= e($product['id'] ?? '') ?></dd>
    <dt>Código</dt><dd><?= e($product['codigo'] ?? '') ?></dd>
    <dt>Categoría</dt><dd><?= e($product['categoria'] ?? '') ?></dd>
    <dt>Precio</dt><dd>Q <?= e(number_format((float) ($product['precio'] ?? 0), 2)) ?></dd>
    <dt>Existencia</dt><dd><?= e($product['existencia'] ?? 0) ?></dd>
</dl>
