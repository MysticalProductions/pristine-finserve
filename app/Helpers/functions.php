<?php

use Core\Session;

function asset(string $path): string
{
    return rtrim(APP_URL, '/') . '/assets/' . ltrim($path, '/');
}

function uploadUrl(string $path): string
{
    return rtrim(APP_URL, '/') . '/storage/uploads/' . ltrim($path, '/');
}

function route(string $path): string
{
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

function adminRoute(string $path = 'dashboard'): string
{
    return route(ADMIN_PREFIX . '/' . ltrim($path, '/'));
}

function old(string $key, mixed $default = ''): mixed
{
    return $_POST[$key] ?? $default;
}

function session(string $key, mixed $default = null): mixed
{
    return Session::instance()->get($key, $default);
}

function flash(string $key, mixed $value = null): mixed
{
    return Session::instance()->flash($key, $value);
}

function hasFlash(string $key): bool
{
    return Session::instance()->hasFlash($key);
}

function auth(): ?object
{
    return Session::instance()->getUser();
}

function isAdmin(): bool
{
    return Session::instance()->isAdmin();
}

function csrfField(): string
{
    $token = Session::instance()->get('csrf_token');
    if (!$token) {
        $token = bin2hex(random_bytes(32));
        Session::instance()->set('csrf_token', $token);
    }
    return '<input type="hidden" name="_token" value="' . $token . '">';
}

function csrfToken(): string
{
    $token = Session::instance()->get('csrf_token');
    if (!$token) {
        $token = bin2hex(random_bytes(32));
        Session::instance()->set('csrf_token', $token);
    }
    return $token;
}

function verifyCsrf(string $token): bool
{
    $stored = Session::instance()->get('csrf_token');
    return hash_equals((string) $stored, $token);
}

function truncate(string $text, int $length = 100): string
{
    if (mb_strlen($text) <= $length) return $text;
    return mb_substr($text, 0, $length) . '...';
}

function formatDate(string $date, string $format = 'M d, Y'): string
{
    return date($format, strtotime($date));
}

function formatCurrency(float $amount): string
{
    return '₹' . number_format($amount, 0, '.', ',');
}

function slugify(string $text): string
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return $text ?: 'n-a';
}

function sanitize(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function sanitizeHtml(string $html): string
{
    return strip_tags($html, '<p><br><b><strong><i><em><u><ul><ol><li><a><h1><h2><h3><h4><h5><h6><img><blockquote><pre><code><table><tr><td><th><thead><tbody><span><div>');
}

function uploadFile(array $file, string $directory = ''): string|false
{
    if ($file['error'] !== UPLOAD_ERR_OK) return false;

    // Sanitize directory path to prevent path traversal
    $directory = preg_replace('/[^a-zA-Z0-9_\/-]/', '', $directory);
    $directory = trim($directory, '/');
    $uploadDir = UPLOADS_PATH . ($directory ? '/' . $directory : '');
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'pdf', 'doc', 'docx', 'xls', 'xlsx'];
    if (!in_array($ext, $allowed)) return false;

    $fileName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
    $filePath = $uploadDir . '/' . $fileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        return ($directory ? trim($directory, '/') . '/' : '') . $fileName;
    }

    return false;
}

function paginateLinks(object $pagination, string $url): string
{
    if ($pagination->lastPage <= 1) return '';

    $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $html = '<nav><ul class="pagination">';
    for ($i = 1; $i <= $pagination->lastPage; $i++) {
        $active = $i === (int) $pagination->page ? ' active' : '';
        $sep = str_contains($url, '?') ? '&' : '?';
        $html .= '<li class="page-item' . $active . '"><a class="page-link" href="' . $url . $sep . 'page=' . $i . '">' . $i . '</a></li>';
    }
    $html .= '</ul></nav>';
    return $html;
}

function activeClass(string $path, string $class = 'active'): string
{
    $current = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    return str_contains($current, $path) ? $class : '';
}

function setting(string $key, mixed $default = ''): mixed
{
    static $settings = null;
    if ($settings === null) {
        try {
            $db = \Core\Database::instance();
            $prefix = $db->getPrefix();
            $rows = $db->fetchAll("SELECT `key`, `value` FROM {$prefix}settings");
            $settings = [];
            foreach ($rows as $row) {
                $settings[$row->key] = $row->value;
            }
        } catch (\Exception $e) {
            $settings = [];
        }
    }
    return $settings[$key] ?? $default;
}

function allServices(): array
{
    static $services = null;
    if ($services === null) {
        try {
            $db = \Core\Database::instance();
            $prefix = $db->getPrefix();
            $services = $db->fetchAll(
                "SELECT * FROM {$prefix}services WHERE status = 'published' ORDER BY `order` ASC"
            );
        } catch (\Exception $e) {
            $services = [];
        }
    }
    return $services;
}

function jsonToLines(mixed $json, string $format = 'default'): string
{
    $data = is_string($json) ? json_decode($json, true) : (is_array($json) ? $json : []);
    if (!is_array($data)) return '';
    $lines = [];
    foreach ($data as $item) {
        if (is_string($item)) {
            $lines[] = $item;
        } elseif (is_array($item)) {
            if ($format === 'faq') {
                $lines[] = ($item['question'] ?? '') . '|' . str_replace(["\r\n", "\r", "\n"], '\\n', $item['answer'] ?? '');
            } else {
                $lines[] = ($item['title'] ?? '') . '|' . str_replace(["\r\n", "\r", "\n"], '\\n', $item['description'] ?? '');
            }
        }
    }
    return implode("\n", $lines);
}

function linesToJson(string $text, string $format = 'default'): string
{
    $lines = explode("\n", $text);
    $items = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;
        if (str_contains($line, '|')) {
            $parts = array_map(fn($v) => str_replace('\\n', "\n", trim($v)), explode('|', $line, 2));
            if (count($parts) === 2) {
                if ($format === 'faq') {
                    $items[] = ['question' => $parts[0], 'answer' => $parts[1]];
                } else {
                    $items[] = ['title' => $parts[0], 'description' => $parts[1]];
                }
            } else {
                $items[] = $parts[0];
            }
        } else {
            $items[] = $line;
        }
    }
    return json_encode($items);
}
