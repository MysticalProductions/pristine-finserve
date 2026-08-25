<?php

namespace Core;

class View
{
    protected string $viewsPath;

    public function __construct()
    {
        $this->viewsPath = __DIR__ . '/../app/Views';
    }

    public static function render(string $template, array $data = []): string
    {
        $instance = new self();
        return $instance->renderTemplate($template, $data);
    }

    public function renderTemplate(string $template, array $data = []): string
    {
        $segments = explode('.', $template);
        if (!empty($segments)) {
            $segments[0] = ucfirst($segments[0]);
        }
        $path = $this->viewsPath . '/' . implode('/', $segments) . '.php';

        if (!file_exists($path)) {
            throw new \Exception("View {$template} not found at {$path}");
        }

        extract($data);
        ob_start();
        include $path;
        return ob_get_clean();
    }

    public static function renderPartial(string $template, array $data = []): string
    {
        $instance = new self();
        return $instance->renderTemplate($template, $data);
    }

    public static function renderJson(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
