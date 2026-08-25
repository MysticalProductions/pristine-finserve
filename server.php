<?php
/**
 * PHP Built-in Server Router
 * Usage: php -S localhost:8000 server.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$publicDir = __DIR__ . '/public';

// Serve uploaded files from storage/uploads/
$storagePrefix = '/storage/uploads/';
if (str_starts_with($uri, $storagePrefix)) {
    $relativePath = substr($uri, strlen($storagePrefix));
    $storageFile = __DIR__ . '/storage/uploads/' . $relativePath;
    if ($relativePath !== '' && file_exists($storageFile) && !is_dir($storageFile)) {
        $ext = strtolower(pathinfo($storageFile, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css' => 'text/css', 'js' => 'application/javascript', 'svg' => 'image/svg+xml',
            'png' => 'image/png', 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
            'gif' => 'image/gif', 'webp' => 'image/webp', 'ico' => 'image/x-icon',
            'pdf' => 'application/pdf',
        ];
        $mime = $mimeTypes[$ext] ?? 'application/octet-stream';
        header("Content-Type: {$mime}");
        readfile($storageFile);
        return true;
    }
}

// Serve existing static files from public/ (skip HTML to allow PHP dynamic routing)
$filePath = $publicDir . $uri;
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    // Skip HTML files so PHP controllers can serve dynamic content
    if ($ext === 'html') {
        // Route through PHP for dynamic content
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        require $publicDir . '/index.php';
        return true;
    }
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'otf' => 'font/otf',
        'ico' => 'image/x-icon',
        'json' => 'application/json',
        'pdf' => 'application/pdf',
    ];
    $mime = $mimeTypes[$ext] ?? 'application/octet-stream';
    header("Content-Type: {$mime}");
    readfile($filePath);
    return true;
}

// Route everything else through index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
require $publicDir . '/index.php';
