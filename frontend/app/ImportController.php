<?php
declare(strict_types=1);

final class ImportController
{
    public function __construct(private GatewayClient $gateway)
    {
    }

    public function form(): void
    {
        View::render('upload', ['title' => 'Nueva importación', 'page' => 'cargar']);
    }

    public function submit(): void
    {
        if (!hash_equals((string) ($_SESSION['csrf'] ?? ''), (string) ($_POST['csrf'] ?? ''))) {
            flash('error', 'La sesión del formulario venció. Vuelve a intentarlo.');
            header('Location: ?page=cargar', true, 303);
            return;
        }
        $file = $_FILES['archivo'] ?? null;
        if (!is_array($file) || (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            flash('error', 'Selecciona un archivo CSV de hasta 5 MB.');
            header('Location: ?page=cargar', true, 303);
            return;
        }
        if ((int) $file['size'] > 5 * 1024 * 1024 || !preg_match('/\.csv$/i', (string) $file['name'])) {
            flash('error', 'El archivo debe ser CSV y no superar 5 MB.');
            header('Location: ?page=cargar', true, 303);
            return;
        }
        if (!is_uploaded_file((string) $file['tmp_name'])) {
            flash('error', 'No se pudo leer el archivo seleccionado.');
            header('Location: ?page=cargar', true, 303);
            return;
        }
        try {
            $result = $this->gateway->import($file);
            flash('success', 'La importación terminó. Revisa el resultado.');
            header('Location: ?page=resultado&id=' . rawurlencode((string) $result['id']), true, 303);
        } catch (RuntimeException $error) {
            flash('error', $error->getMessage());
            header('Location: ?page=cargar', true, 303);
        }
    }

    public function result(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            http_response_code(404);
            View::render('not-found', ['title' => 'Importación no encontrada', 'page' => 'cargar']);
            return;
        }
        try {
            $result = $this->gateway->get('/api/importaciones/' . $id);
            View::render('result', ['title' => 'Resultado de importación', 'page' => 'cargar', 'result' => $result]);
        } catch (RuntimeException $error) {
            View::render('not-found', ['title' => 'Importación no disponible', 'page' => 'cargar', 'error' => $error->getMessage()]);
        }
    }
}
