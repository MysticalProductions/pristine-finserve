<?php

namespace Core;

class Response
{
    public static function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    public static function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        self::redirect($referer);
    }

    public static function with(string $key, mixed $value): void
    {
        Session::instance()->flash($key, $value);
    }

    public static function download(string $filePath, string $fileName = ''): void
    {
        if (!file_exists($filePath)) {
            http_response_code(404);
            exit('File not found');
        }

        $fileName = $fileName ?: basename($filePath);
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    public static function setHeaders(array $headers): void
    {
        foreach ($headers as $key => $value) {
            header("{$key}: {$value}");
        }
    }

    public static function status(int $code): void
    {
        http_response_code($code);
    }
}
