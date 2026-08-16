<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class BlogController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}blog_posts"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT p.*, c.name as category_name
             FROM {$this->prefix}blog_posts p
             LEFT JOIN {$this->prefix}blog_categories c ON c.id = p.category_id
             ORDER BY p.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $this->render('admin.blogs.index', compact('pagination'));
    }

    public function create(Request $request): void
    {
        $categories = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}blog_categories WHERE status = 'active' ORDER BY name ASC"
        );

        $this->render('admin.blogs.create', compact('categories'));
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

        $data = $request->only([
            'title', 'slug', 'excerpt', 'content', 'category_id',
            'meta_title', 'meta_description', 'meta_keywords',
            'status', 'is_featured', 'published_at'
        ]);

        $tags = $request->input('tags', '');
        $data['tags'] = !empty($tags) ? json_encode(array_map('trim', explode(',', $tags))) : null;

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'blog');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'draft';
        if (!isset($data['is_featured'])) $data['is_featured'] = 0;
        if (empty($data['published_at']) && $data['status'] === 'published') {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $this->db->insert('blog_posts', $data);

        $this->session->flash('success', 'Blog post created successfully.');
        $this->redirect(adminRoute('blogs'));
    }

    public function edit(Request $request, int $id): void
    {
        $post = $this->db->fetch(
            "SELECT * FROM {$this->prefix}blog_posts WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$post) {
            $this->session->flash('error', 'Blog post not found.');
            $this->redirect(adminRoute('blogs'));
            return;
        }

        $categories = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}blog_categories WHERE status = 'active' ORDER BY name ASC"
        );

        $this->render('admin.blogs.edit', compact('post', 'categories'));
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

        $data = $request->only([
            'title', 'slug', 'excerpt', 'content', 'category_id',
            'meta_title', 'meta_description', 'meta_keywords',
            'status', 'is_featured', 'published_at'
        ]);

        $tags = $request->input('tags', '');
        $data['tags'] = !empty($tags) ? json_encode(array_map('trim', explode(',', $tags))) : null;

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'blog');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['is_featured'])) $data['is_featured'] = 0;
        if (empty($data['published_at']) && ($data['status'] ?? '') === 'published') {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $this->db->update('blog_posts', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Blog post updated successfully.');
        $this->redirect(adminRoute('blogs'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('blog_posts', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Blog post deleted successfully.');
        $this->redirect(adminRoute('blogs'));
    }
}
