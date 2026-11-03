<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Gestión de productos') ?> | Gestión de productos</title>
</head>
<body>
    <header>
        <p>Gestión de productos</p>
        <nav aria-label="Navegación principal">
            <a href="?page=inicio" <?= ($page ?? '') === 'inicio' ? 'aria-current="page"' : '' ?>>Resumen</a>
            <a href="?page=cargar" <?= ($page ?? '') === 'cargar' ? 'aria-current="page"' : '' ?>>Cargar CSV</a>
            <a href="?page=productos" <?= ($page ?? '') === 'productos' ? 'aria-current="page"' : '' ?>>Productos</a>
            <a href="?page=historial" <?= ($page ?? '') === 'historial' ? 'aria-current="page"' : '' ?>>Historial</a>
        </nav>
    </header>
    <?php if (isset($_SESSION['flash'])): ?>
        <?php $notice = $_SESSION['flash']; unset($_SESSION['flash']); ?>
        <p role="status" data-type="<?= e($notice['type']) ?>"><?= e($notice['message']) ?></p>
    <?php endif; ?>
    <main>
        <?= $content ?>
    </main>
</body>
</html>
