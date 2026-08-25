<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class PartnerController extends BaseController
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
        $search = trim($request->input('search', ''));

        $where = '';
        $params = [];

        if ($search !== '') {
            $where = "WHERE name LIKE :search OR type LIKE :search2 OR description LIKE :search3";
            $params['search'] = "%{$search}%";
            $params['search2'] = "%{$search}%";
            $params['search3'] = "%{$search}%";
        }

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->prefix}partners {$where}",
            $params
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}partners {$where} ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $partners = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.partners.index', compact('pagination', 'partners', 'search'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.partners.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'type' => 'required',
            'logo' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'slug', 'type', 'description', 'website', 'status', 'order'
        ]);

        if ($request->hasFile('logo')) {
            $uploaded = uploadFile($request->file('logo'), 'partners');
            if ($uploaded) {
                $data['logo'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'active';
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->insert('partners', $data);

        $this->session->flash('success', 'Partner created successfully.');
        $this->redirect(adminRoute('partners'));
    }

    public function edit(Request $request, int $id): void
    {
        $partner = $this->db->fetch(
            "SELECT * FROM {$this->prefix}partners WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$partner) {
            $this->session->flash('error', 'Partner not found.');
            $this->redirect(adminRoute('partners'));
            return;
        }

        $this->render('admin.partners.edit', ['partner' => (array) $partner]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'type' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'slug', 'type', 'description', 'website', 'status', 'order'
        ]);

        if ($request->hasFile('logo')) {
            $uploaded = uploadFile($request->file('logo'), 'partners');
            if ($uploaded) {
                $data['logo'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->update('partners', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Partner updated successfully.');
        $this->redirect(adminRoute('partners'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('partners', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Partner deleted successfully.');
        $this->redirect(adminRoute('partners'));
    }
}
