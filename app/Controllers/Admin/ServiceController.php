<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class ServiceController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}services"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}services ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $services = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.services.index', compact('pagination', 'services'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.services.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'short_desc' => 'required|max:500',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'title', 'slug', 'icon', 'short_desc', 'content',
            'features', 'process', 'benefits', 'faq',
            'status', 'featured_image', 'order'
        ]);

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'services');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'published';
        if (!isset($data['order'])) $data['order'] = 0;

        if (isset($data['features'])) $data['features'] = linesToJson($data['features']);
        if (isset($data['benefits'])) $data['benefits'] = linesToJson($data['benefits']);
        if (isset($data['process'])) $data['process'] = linesToJson($data['process']);
        if (isset($data['faq'])) $data['faq'] = linesToJson($data['faq'], 'faq');

        $this->db->insert('services', $data);

        $this->session->flash('success', 'Service created successfully.');
        $this->redirect(adminRoute('services'));
    }

    public function edit(Request $request, int $id): void
    {
        $service = $this->db->fetch(
            "SELECT * FROM {$this->prefix}services WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$service) {
            $this->session->flash('error', 'Service not found.');
            $this->redirect(adminRoute('services'));
            return;
        }

        $service = (array) $service;
        $service['features'] = jsonToLines($service['features'] ?? '');
        $service['benefits'] = jsonToLines($service['benefits'] ?? '');
        $service['process'] = jsonToLines($service['process'] ?? '');
        $service['faq'] = jsonToLines($service['faq'] ?? '', 'faq');
        $this->render('admin.services.edit', ['service' => $service]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'short_desc' => 'required|max:500',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'title', 'slug', 'icon', 'short_desc', 'content',
            'features', 'process', 'benefits', 'faq',
            'status', 'order'
        ]);

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'services');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['order'])) $data['order'] = 0;

        if (isset($data['features'])) $data['features'] = linesToJson($data['features']);
        if (isset($data['benefits'])) $data['benefits'] = linesToJson($data['benefits']);
        if (isset($data['process'])) $data['process'] = linesToJson($data['process']);
        if (isset($data['faq'])) $data['faq'] = linesToJson($data['faq'], 'faq');

        $this->db->update('services', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Service updated successfully.');
        $this->redirect(adminRoute('services'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('services', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Service deleted successfully.');
        $this->redirect(adminRoute('services'));
    }
}
