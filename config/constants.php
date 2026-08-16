<?php

define('APP_NAME', 'Pristine Finserve');
define('APP_URL', getenv('APP_URL') ?: (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http')
    . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')
));
define('APP_ENV', (getenv('APP_ENV') ?: 'production'));
define('APP_DEBUG', (bool) (getenv('APP_DEBUG') ?: false));
define('APP_TIMEZONE', 'Asia/Kolkata');
define('UPLOADS_PATH', __DIR__ . '/../storage/uploads');
define('UPLOADS_URL', APP_URL . '/storage/uploads');
define('ADMIN_PREFIX', 'admin');
define('ITEMS_PER_PAGE', 15);
