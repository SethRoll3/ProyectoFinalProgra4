<?php
declare(strict_types=1);

final class ProductController
{
    public function __construct(private GatewayClient $gateway)
    {
    }

    public function index(): void
    {
        $filters = [
            'codigo' => trim((string) ($_GET['codigo'] ?? '')),
            'nombre' => trim((string) ($_GET['nombre'] ?? '')),
            'categoria' => trim((string) ($_GET['categoria'] ?? '')),
        ];
        $page = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
        $page = is_int($page) && $page > 0 ? min($page, 100000) : 1;
        try {
            $categories = $this->gateway->get('/api/categorias');
            $products = $this->gateway->get('/api/productos', $filters + ['page' => $page - 1, 'size' => 10]);
            View::render('products', [
                'title' => 'Productos',
                'page' => 'productos',
                'filters' => $filters,
                'categories' => $categories,
                'products' => $products,
                'currentPage' => $page,
            ]);
        } catch (RuntimeException $error) {
            View::render('products', [
                'title' => 'Productos',
                'page' => 'productos',
                'filters' => $filters,
                'categories' => [],
                'products' => ['content' => [], 'totalElements' => 0, 'totalPages' => 0],
                'currentPage' => $page,
                'error' => $error->getMessage(),
            ]);
        }
    }

    public function detail(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!is_int($id) || $id < 1) {
            http_response_code(404);
            View::render('not-found', ['title' => 'Producto no encontrado', 'page' => 'productos']);
            return;
        }
        try {
            $product = $this->gateway->get('/api/productos/' . $id);
            View::render('product-detail', ['title' => 'Detalle de producto', 'page' => 'productos', 'product' => $product]);
        } catch (RuntimeException $error) {
            http_response_code(404);
            View::render('not-found', ['title' => 'Producto no disponible', 'page' => 'productos', 'error' => $error->getMessage()]);
        }
    }
}
