<?php

return [
    'name' => 'Pristine Finserve',
    'url' => getenv('APP_URL') ?: (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
),
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => (bool) (getenv('APP_DEBUG') ?: false),
    'timezone' => 'Asia/Kolkata',
    'locale' => 'en',
    'uploads_path' => __DIR__ . '/../storage/uploads',
    'uploads_url' => '/storage/uploads',
    'admin_prefix' => 'admin',
    'items_per_page' => 15,
];
