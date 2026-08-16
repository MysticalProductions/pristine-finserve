<?php

namespace App\Services;

use Core\Database;
use Core\Session;

class AuthService
{
    private Database $db;
    private Session $session;

    public function __construct()
    {
        $this->db = Database::instance();
        $this->session = Session::instance();
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->db->fetch(
            "SELECT * FROM {$this->db->getPrefix()}users WHERE email = :email LIMIT 1",
            ['email' => $email]
        );

        if (!$user || !$this->verifyPassword($password, $user->password)) {
            return false;
        }

        unset($user->password);
        $this->session->setUser($user);
        $this->session->regenerate();

        $this->db->update(
            'users',
            ['last_login' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $user->id]
        );

        return true;
    }

    public function logout(): void
    {
        $this->session->destroy();
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public function getCurrentUser(): ?object
    {
        return $this->session->getUser();
    }

    public function hasPermission(string $permission): bool
    {
        $user = $this->getCurrentUser();
        if (!$user || !isset($user->role_id)) {
            return false;
        }

        if ($user->role_id <= 2) {
            return true;
        }

        $perm = $this->db->fetch(
            "SELECT 1 FROM {$this->db->getPrefix()}role_permissions rp
             JOIN {$this->db->getPrefix()}permissions p ON p.id = rp.permission_id
             WHERE rp.role_id = :role_id AND p.slug = :slug LIMIT 1",
            ['role_id' => $user->role_id, 'slug' => $permission]
        );

        return (bool) $perm;
    }
}
