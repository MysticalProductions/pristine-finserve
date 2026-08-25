<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class GalleryController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}gallery"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}gallery ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $gallery = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.gallery.index', compact('pagination', 'gallery'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.gallery.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'type' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'title', 'description', 'video_url', 'type', 'category',
            'status', 'is_featured', 'order'
        ]);

        if ($request->hasFile('image')) {
            $uploaded = uploadFile($request->file('image'), 'gallery');
            if ($uploaded) {
                $data['image'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'active';
        if (!isset($data['is_featured'])) $data['is_featured'] = 0;
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->insert('gallery', $data);

        $this->session->flash('success', 'Gallery item created successfully.');
        $this->redirect(adminRoute('gallery'));
    }

    public function edit(Request $request, int $id): void
    {
        $item = $this->db->fetch(
            "SELECT * FROM {$this->prefix}gallery WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$item) {
            $this->session->flash('error', 'Gallery item not found.');
            $this->redirect(adminRoute('gallery'));
            return;
        }

        $this->render('admin.gallery.edit', ['item' => (array) $item]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'type' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'title', 'description', 'video_url', 'type', 'category',
            'status', 'is_featured', 'order'
        ]);

        if ($request->hasFile('image')) {
            $uploaded = uploadFile($request->file('image'), 'gallery');
            if ($uploaded) {
                $data['image'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['is_featured'])) $data['is_featured'] = 0;
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->update('gallery', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Gallery item updated successfully.');
        $this->redirect(adminRoute('gallery'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('gallery', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Gallery item deleted successfully.');
        $this->redirect(adminRoute('gallery'));
    }
}
