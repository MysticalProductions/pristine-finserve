<?php

namespace App\Controllers\Admin;

use App\Services\AuthService;
use Core\Controller;
use Core\Database;
use Core\Request;

class UserController extends BaseController
{
    private Database $db;
    private string $prefix;
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::instance();
        $this->prefix = $this->db->getPrefix();
        $this->authService = new AuthService();
    }

    public function index(Request $request): void
    {
        $page = (int) $request->input('page', 1);
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->prefix}users"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT u.*, r.name as role_name
             FROM {$this->prefix}users u
             LEFT JOIN {$this->prefix}roles r ON r.id = u.role_id
             ORDER BY u.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $this->render('admin.users.index', compact('pagination'));
    }

    public function create(Request $request): void
    {
        $roles = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}roles ORDER BY name ASC"
        );

        $this->render('admin.users.create', compact('roles'));
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $existing = $this->db->fetch(
            "SELECT id FROM {$this->prefix}users WHERE email = :email LIMIT 1",
            ['email' => $request->input('email')]
        );

        if ($existing) {
            $this->session->flash('error', 'A user with this email already exists.');
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['name', 'email', 'role_id', 'phone', 'status']);
        $data['password'] = $this->authService->hashPassword($request->input('password', ''));
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->insert('users', $data);

        $this->session->flash('success', 'User created successfully.');
        $this->redirect(adminRoute('users'));
    }

    public function edit(Request $request, int $id): void
    {
        $user = $this->db->fetch(
            "SELECT * FROM {$this->prefix}users WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$user) {
            $this->session->flash('error', 'User not found.');
            $this->redirect(adminRoute('users'));
            return;
        }

        $roles = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}roles ORDER BY name ASC"
        );

        $this->render('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $existing = $this->db->fetch(
            "SELECT id FROM {$this->prefix}users WHERE email = :email AND id != :id LIMIT 1",
            ['email' => $request->input('email'), 'id' => $id]
        );

        if ($existing) {
            $this->session->flash('error', 'A user with this email already exists.');
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['name', 'email', 'role_id', 'phone', 'status']);
        $data['updated_at'] = date('Y-m-d H:i:s');

        $password = $request->input('password', '');
        if (!empty($password)) {
            $data['password'] = $this->authService->hashPassword($password);
        }

        $this->db->update('users', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'User updated successfully.');
        $this->redirect(adminRoute('users'));
    }

    public function delete(Request $request, int $id): void
    {
        $currentUser = $this->session->getUser();

        if ($currentUser && (int) $currentUser->id === $id) {
            $this->session->flash('error', 'You cannot delete your own account.');
            $this->redirect(adminRoute('users'));
            return;
        }

        // Only allow Super Admin (role_id 1) and Admin (role_id 2) to delete users
        if (!$currentUser || !in_array((int) $currentUser->role_id, [1, 2], true)) {
            $this->session->flash('error', 'You do not have permission to delete users.');
            $this->redirect(adminRoute('users'));
            return;
        }

        $this->db->delete('users', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'User deleted successfully.');
        $this->redirect(adminRoute('users'));
    }
}
