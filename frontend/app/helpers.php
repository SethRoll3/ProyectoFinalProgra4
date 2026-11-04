<?php
declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function displayDate(mixed $value): string
{
    if ($value === null || $value === '') {
        return '';
    }
    try {
        return (new DateTimeImmutable((string) $value))->format('d/m/Y · H:i');
    } catch (Exception) {
        return (string) $value;
    }
}
