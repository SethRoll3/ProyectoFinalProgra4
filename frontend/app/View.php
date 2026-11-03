<?php
declare(strict_types=1);

final class View
{
    public static function render(string $name, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require __DIR__ . '/views/' . $name . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/views/layout.php';
    }
}
