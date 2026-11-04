<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Gestión de productos') ?> | Gestión de productos</title>
    <link rel="icon" type="image/svg+xml" href="/assets/mark.svg">
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <header class="sidebar">
        <div class="brand"><img class="brand-mark" src="/assets/mark.svg" alt="" width="43" height="43"><span>GESTIÓN<br><strong>DE PRODUCTOS</strong></span></div>
        <p class="sidebar-caption">Panel de control</p>
        <nav aria-label="Navegación principal">
            <a href="?page=inicio" <?= ($page ?? '') === 'inicio' ? 'aria-current="page"' : '' ?>>Resumen</a>
            <a href="?page=cargar" <?= ($page ?? '') === 'cargar' ? 'aria-current="page"' : '' ?>>Cargar CSV</a>
            <a href="?page=productos" <?= ($page ?? '') === 'productos' ? 'aria-current="page"' : '' ?>>Productos</a>
            <a href="?page=historial" <?= ($page ?? '') === 'historial' ? 'aria-current="page"' : '' ?>>Historial</a>
        </nav>
        <div class="sidebar-foot"><span class="live-dot"></span> Entorno local <small>PHP · Gateway · Spring Boot</small></div>
    </header>
    <?php if (isset($_SESSION['flash'])): ?>
        <?php $notice = $_SESSION['flash']; unset($_SESSION['flash']); ?>
        <p class="toast" role="status" data-type="<?= e($notice['type']) ?>"><?= e($notice['message']) ?></p>
    <?php endif; ?>
    <main class="main-content">
        <div class="topline"><span>INVENTARIO / <?= e(mb_strtoupper($title ?? 'RESUMEN', 'UTF-8')) ?></span><span>PLATAFORMA DE IMPORTACIÓN</span></div>
        <?= $content ?>
    </main>
</body>
</html>
