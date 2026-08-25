<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class TeamController extends BaseController
{
    private Database $db;
    private string $prefix;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::instance();
        $this->prefix = $this->db->getPrefix();
    }

    public function index(Request $request): void
    {
        $page = (int) $request->input('page', 1);
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->prefix}team"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}team ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $team = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.team.index', compact('pagination', 'team'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.team.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'designation' => 'required|max:255',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'designation', 'bio', 'email', 'phone',
            'linkedin', 'twitter', 'order', 'status'
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = uploadFile($request->file('photo'), 'team');
            if ($uploaded) {
                $data['photo'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'active';
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->insert('team', $data);

        $this->session->flash('success', 'Promoter profile created successfully.');
        $this->redirect(adminRoute('team'));
    }

    public function edit(Request $request, int $id): void
    {
        $member = $this->db->fetch(
            "SELECT * FROM {$this->prefix}team WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$member) {
            $this->session->flash('error', 'Promoter profile not found.');
            $this->redirect(adminRoute('team'));
            return;
        }

        $this->render('admin.team.edit', ['member' => (array) $member]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'designation' => 'required|max:255',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'designation', 'bio', 'email', 'phone',
            'linkedin', 'twitter', 'order', 'status'
        ]);

        if ($request->hasFile('photo')) {
            $uploaded = uploadFile($request->file('photo'), 'team');
            if ($uploaded) {
                $data['photo'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->update('team', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Promoter profile updated successfully.');
        $this->redirect(adminRoute('team'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('team', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Promoter profile deleted successfully.');
        $this->redirect(adminRoute('team'));
    }
}
