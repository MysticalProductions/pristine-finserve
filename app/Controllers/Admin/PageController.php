<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class PageController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}pages"
        )->count ?? 0;

        $pages = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}pages ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));

        $pagination = (object) compact('total', 'page', 'perPage', 'lastPage');
        $pagination->items = $pages;

        $pages = array_map(fn($v) => (array) $v, $pages);

        $this->render('admin.pages.index', compact('pagination', 'pages'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.pages.create', ['page' => []]);
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['title', 'slug', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'show_in_menu', 'menu_order', 'status']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['show_in_menu'])) $data['show_in_menu'] = 0;
        if (!isset($data['status'])) $data['status'] = 'draft';

        $this->db->insert('pages', $data);

        $this->session->flash('success', 'Page created successfully.');
        $this->redirect(adminRoute('pages'));
    }

    public function edit(Request $request, int $id): void
    {
        $page = $this->db->fetch(
            "SELECT * FROM {$this->prefix}pages WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$page) {
            $this->session->flash('error', 'Page not found.');
            $this->redirect(adminRoute('pages'));
            return;
        }

        $this->render('admin.pages.edit', ['page' => (array) $page]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['title', 'slug', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'show_in_menu', 'menu_order', 'status']);
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['show_in_menu'])) $data['show_in_menu'] = 0;

        $this->db->update('pages', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Page updated successfully.');
        $this->redirect(adminRoute('pages'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('pages', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Page deleted successfully.');
        $this->redirect(adminRoute('pages'));
    }
}
