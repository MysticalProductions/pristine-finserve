<?php

namespace App\Middleware;

use Core\Session;

class RoleMiddleware
{
    protected array $allowedRoles;

    public function __construct(array $allowedRoles = [])
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(): void
    {
        $session = Session::instance();
        $user = $session->getUser();

        if (!$user) {
            header('Location: ' . adminRoute('login'));
            exit;
        }

        if (!empty($this->allowedRoles) && !in_array($user->role_id, $this->allowedRoles)) {
            http_response_code(403);
            echo 'Access denied. Insufficient permissions.';
            exit;
        }
    }
}
