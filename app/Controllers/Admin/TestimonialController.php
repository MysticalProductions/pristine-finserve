<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class TestimonialController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}testimonials"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}testimonials ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $testimonials = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.testimonials.index', compact('pagination', 'testimonials'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.testimonials.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'client_name' => 'required|min:2|max:255',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'client_name', 'client_company', 'client_designation',
            'rating', 'content', 'loan_type', 'amount_sanctioned',
            'status', 'is_featured', 'order'
        ]);

        if ($request->hasFile('client_photo')) {
            $uploaded = uploadFile($request->file('client_photo'), 'testimonials');
            if ($uploaded) {
                $data['client_photo'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['is_featured'])) $data['is_featured'] = 0;
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->insert('testimonials', $data);

        $this->session->flash('success', 'Testimonial created successfully.');
        $this->redirect(adminRoute('testimonials'));
    }

    public function edit(Request $request, int $id): void
    {
        $testimonial = $this->db->fetch(
            "SELECT * FROM {$this->prefix}testimonials WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$testimonial) {
            $this->session->flash('error', 'Testimonial not found.');
            $this->redirect(adminRoute('testimonials'));
            return;
        }

        $this->render('admin.testimonials.edit', ['testimonial' => (array) $testimonial]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'client_name' => 'required|min:2|max:255',
            'content' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'client_name', 'client_company', 'client_designation',
            'rating', 'content', 'loan_type', 'amount_sanctioned',
            'status', 'is_featured', 'order'
        ]);

        if ($request->hasFile('client_photo')) {
            $uploaded = uploadFile($request->file('client_photo'), 'testimonials');
            if ($uploaded) {
                $data['client_photo'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['rating'])) $data['rating'] = 5;
        if (!isset($data['is_featured'])) $data['is_featured'] = 0;

        $this->db->update('testimonials', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Testimonial updated successfully.');
        $this->redirect(adminRoute('testimonials'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('testimonials', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Testimonial deleted successfully.');
        $this->redirect(adminRoute('testimonials'));
    }
}
