<?php
declare(strict_types=1);

final class HistoryController
{
    public function __construct(private GatewayClient $gateway)
    {
    }

    public function index(): void
    {
        $page = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);
        $page = is_int($page) && $page > 0 ? min($page, 100000) : 1;
        try {
            $history = $this->gateway->get('/api/importaciones', ['page' => $page - 1, 'size' => 10]);
            View::render('history', [
                'title' => 'Historial de importaciones',
                'page' => 'historial',
                'history' => $history,
                'currentPage' => $page,
            ]);
        } catch (RuntimeException $error) {
            View::render('history', [
                'title' => 'Historial de importaciones',
                'page' => 'historial',
                'history' => ['content' => [], 'totalElements' => 0, 'totalPages' => 0],
                'currentPage' => $page,
                'error' => $error->getMessage(),
            ]);
        }
    }
}
