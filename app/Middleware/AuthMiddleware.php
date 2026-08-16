<?php

namespace App\Middleware;

use Core\Session;

class AuthMiddleware
{
    public function handle(): void
    {
        $session = Session::instance();
        if (!$session->isLoggedIn()) {
            header('Location: ' . adminRoute('login'));
            exit;
        }
    }
}
