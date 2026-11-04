<?php
declare(strict_types=1);

final class GatewayClient
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(getenv('GATEWAY_URL') ?: 'http://localhost:8080', '/');
    }

    public function get(string $path, array $query = []): array
    {
        $url = $this->baseUrl . $path;
        if ($query !== []) {
            $parameters = [];
            foreach ($query as $name => $value) {
                $parameters[] = rawurlencode((string) $name) . '=' . rawurlencode((string) $value);
            }
            $url .= '?' . implode('&', $parameters);
        }
        return $this->request($url);
    }

    public function import(array $file): array
    {
        $name = basename((string) ($file['name'] ?? 'archivo.csv'));
        $name = preg_replace('/[\x00-\x1f\x7f]/', '', $name) ?: 'archivo.csv';
        $upload = new CURLFile((string) $file['tmp_name'], 'text/csv', $name);
        return $this->request($this->baseUrl . '/api/importaciones', ['archivo' => $upload]);
    }

    private function request(string $url, ?array $fields = null): array
    {
        $curl = curl_init($url);
        if ($curl === false) {
            throw new RuntimeException('No se pudo iniciar la conexión con el backend.');
        }
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 45,
            CURLOPT_HTTPHEADER => ['Accept: application/json'],
        ]);
        if ($fields !== null) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $fields);
        }
        $body = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);
        if ($body === false) {
            throw new RuntimeException('No se pudo conectar con Gateway. Comprueba que el backend esté encendido.');
        }
        $data = json_decode($body, true);
        if ($status < 200 || $status >= 300) {
            $message = is_array($data) ? ($data['error'] ?? null) : null;
            throw new RuntimeException(is_string($message) ? $message : 'El backend no pudo completar la solicitud.');
        }
        if (!is_array($data)) {
            throw new RuntimeException('Gateway devolvió una respuesta inesperada.');
        }
        return $data;
    }
}
