<?php
declare(strict_types=1);

session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
$_SESSION['csrf'] ??= bin2hex(random_bytes(32));

require dirname(__DIR__) . '/app/helpers.php';
require dirname(__DIR__) . '/app/GatewayClient.php';
require dirname(__DIR__) . '/app/View.php';
require dirname(__DIR__) . '/app/DashboardController.php';
require dirname(__DIR__) . '/app/ImportController.php';
require dirname(__DIR__) . '/app/ProductController.php';
require dirname(__DIR__) . '/app/HistoryController.php';

$gateway = new GatewayClient();
$page = $_GET['page'] ?? 'inicio';

if ($page === 'inicio' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new DashboardController($gateway))->index();
} elseif ($page === 'cargar' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new ImportController($gateway))->form();
} elseif ($page === 'cargar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    (new ImportController($gateway))->submit();
} elseif ($page === 'resultado' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new ImportController($gateway))->result();
} elseif ($page === 'productos' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new ProductController($gateway))->index();
} elseif ($page === 'producto' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new ProductController($gateway))->detail();
} elseif ($page === 'historial' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    (new HistoryController($gateway))->index();
} else {
    http_response_code(404);
    View::render('not-found', ['title' => 'Página no encontrada', 'page' => '']);
}
