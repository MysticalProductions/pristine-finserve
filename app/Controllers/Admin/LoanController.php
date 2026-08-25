<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class LoanController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}loan_products"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}loan_products ORDER BY `order` ASC, created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $loans = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.loans.index', compact('pagination', 'loans'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.loans.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'short_desc' => 'required|max:500',
            'description' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'slug', 'icon', 'short_desc', 'description',
            'min_amount', 'max_amount', 'min_rate', 'max_rate',
            'min_tenure_months', 'max_tenure_months', 'processing_fee',
            'eligibility', 'documents', 'features', 'interest_type',
            'benefits', 'faq', 'status', 'order'
        ]);

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'loans');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        if ($request->hasFile('brochure')) {
            $uploaded = uploadFile($request->file('brochure'), 'loans/brochures');
            if ($uploaded) {
                $data['brochure'] = $uploaded;
            }
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['status'])) $data['status'] = 'published';
        if (!isset($data['order'])) $data['order'] = 0;

        if (isset($data['eligibility'])) $data['eligibility'] = linesToJson($data['eligibility']);
        if (isset($data['documents'])) $data['documents'] = linesToJson($data['documents']);
        if (isset($data['features'])) $data['features'] = linesToJson($data['features']);
        if (isset($data['benefits'])) $data['benefits'] = linesToJson($data['benefits']);
        if (isset($data['faq'])) $data['faq'] = linesToJson($data['faq'], 'faq');

        $this->db->insert('loan_products', $data);

        $this->session->flash('success', 'Loan product created successfully.');
        $this->redirect(adminRoute('loans'));
    }

    public function edit(Request $request, int $id): void
    {
        $loan = $this->db->fetch(
            "SELECT * FROM {$this->prefix}loan_products WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$loan) {
            $this->session->flash('error', 'Loan product not found.');
            $this->redirect(adminRoute('loans'));
            return;
        }

        $loan = (array) $loan;
        $loan['eligibility'] = jsonToLines($loan['eligibility'] ?? '');
        $loan['documents'] = jsonToLines($loan['documents'] ?? '');
        $loan['features'] = jsonToLines($loan['features'] ?? '');
        $loan['benefits'] = jsonToLines($loan['benefits'] ?? '');
        $loan['faq'] = jsonToLines($loan['faq'] ?? '', 'faq');
        $this->render('admin.loans.edit', ['loan' => $loan]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
            'short_desc' => 'required|max:500',
            'description' => 'required',
            'min_amount' => 'required',
            'max_amount' => 'required',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only([
            'name', 'slug', 'icon', 'short_desc', 'description',
            'min_amount', 'max_amount', 'min_rate', 'max_rate',
            'min_tenure_months', 'max_tenure_months', 'processing_fee',
            'eligibility', 'documents', 'features', 'interest_type',
            'benefits', 'faq', 'status', 'order'
        ]);

        if ($request->hasFile('featured_image')) {
            $uploaded = uploadFile($request->file('featured_image'), 'loans');
            if ($uploaded) {
                $data['featured_image'] = $uploaded;
            }
        }

        if ($request->hasFile('brochure')) {
            $uploaded = uploadFile($request->file('brochure'), 'loans/brochures');
            if ($uploaded) {
                $data['brochure'] = $uploaded;
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!isset($data['order'])) $data['order'] = 0;

        if (isset($data['eligibility'])) $data['eligibility'] = linesToJson($data['eligibility']);
        if (isset($data['documents'])) $data['documents'] = linesToJson($data['documents']);
        if (isset($data['features'])) $data['features'] = linesToJson($data['features']);
        if (isset($data['benefits'])) $data['benefits'] = linesToJson($data['benefits']);
        if (isset($data['faq'])) $data['faq'] = linesToJson($data['faq'], 'faq');

        $this->db->update('loan_products', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Loan product updated successfully.');
        $this->redirect(adminRoute('loans'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('loan_products', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Loan product deleted successfully.');
        $this->redirect(adminRoute('loans'));
    }
}
