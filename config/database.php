<?php

return [
    'host' => getenv('DB_HOST') ?: 'localhost',
    'port' => getenv('DB_PORT') ?: '3306',
    'socket' => getenv('DB_SOCKET') ?: '/tmp/mysql.sock',
    'database' => getenv('DB_NAME') ?: 'pristine_finserve',
    'username' => getenv('DB_USER') ?: 'root',
    'password' => getenv('DB_PASS') ?: '',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => 'pf_',
    'use_socket' => getenv('DB_USE_SOCKET') !== false ? filter_var(getenv('DB_USE_SOCKET'), FILTER_VALIDATE_BOOLEAN) : true,
];
