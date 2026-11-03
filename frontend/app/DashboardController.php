<?php
declare(strict_types=1);

final class DashboardController
{
    public function __construct(private GatewayClient $gateway)
    {
    }

    public function index(): void
    {
        try {
            $products = $this->gateway->get('/api/productos', ['size' => 1]);
            $imports = $this->gateway->get('/api/importaciones', ['size' => 5]);
            View::render('dashboard', [
                'title' => 'Resumen',
                'page' => 'inicio',
                'productCount' => (int) ($products['totalElements'] ?? 0),
                'importCount' => (int) ($imports['totalElements'] ?? 0),
                'recent' => $imports['content'] ?? [],
            ]);
        } catch (RuntimeException $error) {
            View::render('dashboard', [
                'title' => 'Resumen',
                'page' => 'inicio',
                'productCount' => null,
                'importCount' => null,
                'recent' => [],
                'error' => $error->getMessage(),
            ]);
        }
    }
}
