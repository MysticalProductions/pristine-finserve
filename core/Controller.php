<?php

namespace Core;

abstract class Controller
{
    protected View $view;
    protected Request $request;
    protected Session $session;
    protected ?string $layout = null;

    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        $this->session = Session::instance();
    }

    protected function render(string $template, array $data = []): void
    {
        $content = $this->view->renderTemplate($template, $data);

        if ($this->layout) {
            $layoutData = array_merge($data, ['content' => $content]);
            echo $this->view->renderTemplate($this->layout, $layoutData);
        } else {
            echo $content;
        }
    }

    protected function json(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    protected function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        $this->redirect($referer);
    }

    protected function validate(array $rules, array $data = []): array
    {
        $errors = [];
        $data = $data ?: array_merge($_POST, $_FILES);

        foreach ($rules as $field => $ruleSet) {
            $ruleList = is_array($ruleSet) ? $ruleSet : explode('|', $ruleSet);
            $value = $data[$field] ?? '';

            foreach ($ruleList as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $errors[$field][] = "{$field} is required";
                }
                if (str_starts_with($rule, 'min:') && strlen($value) < (int) substr($rule, 4)) {
                    $errors[$field][] = "{$field} must be at least " . substr($rule, 4) . " characters";
                }
                if (str_starts_with($rule, 'max:') && strlen($value) > (int) substr($rule, 4)) {
                    $errors[$field][] = "{$field} must not exceed " . substr($rule, 4) . " characters";
                }
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "{$field} must be a valid email";
                }
            }
        }

        return $errors;
    }
}
