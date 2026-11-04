<p class="back-link"><a href="?page=productos">← Volver a productos</a></p>
<section class="product-hero">
    <div class="product-hero-main">
        <span class="eyebrow">CATÁLOGO / FICHA DE PRODUCTO</span>
        <h1><?= e($product['nombre'] ?? 'Producto') ?></h1>
        <p>Información del producto registrado en el catálogo.</p>
        <div class="product-tags">
            <span><?= e($product['categoria'] ?? '') ?></span>
            <span>Código <?= e($product['codigo'] ?? '') ?></span>
        </div>
    </div>
    <div class="product-price">
        <span class="eyebrow">PRECIO UNITARIO</span>
        <strong>Q <?= e(number_format((float) ($product['precio'] ?? 0), 2)) ?></strong>
        <small>Por unidad</small>
    </div>
</section>
<section class="detail-cards" aria-label="Datos del producto">
    <div class="detail-card detail-card-stock"><span class="eyebrow">EXISTENCIA DISPONIBLE</span><div><strong><?= e($product['existencia'] ?? 0) ?></strong><span>unidades</span></div></div>
    <div class="detail-card"><span class="eyebrow">CATEGORÍA</span><strong><?= e($product['categoria'] ?? '') ?></strong></div>
    <div class="detail-card"><span class="eyebrow">IDENTIFICADOR</span><strong>#<?= e($product['id'] ?? '') ?></strong></div>
</section>
