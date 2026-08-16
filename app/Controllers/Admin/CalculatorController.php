<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class CalculatorController extends BaseController
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
        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}calculators ORDER BY `order` ASC"
        );

        $calculators = array_map(fn($v) => (array) $v, $items);

        $this->render('admin.calculators.index', compact('calculators'));
    }

    public function edit(Request $request, int $id): void
    {
        $calculator = $this->db->fetch(
            "SELECT * FROM {$this->prefix}calculators WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$calculator) {
            $this->session->flash('error', 'Calculator not found.');
            $this->redirect(adminRoute('calculators'));
            return;
        }

        $this->render('admin.calculators.edit', ['calculator' => (array) $calculator]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'title' => 'required|min:2|max:255',
            'slug' => 'required|min:2|max:255',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->back();
            return;
        }

        $data = $request->only([
            'title', 'slug', 'type', 'description',
            'default_rate', 'default_tenure', 'default_amount',
            'status', 'order'
        ]);

        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->update('calculators', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Calculator updated successfully.');
        $this->redirect(adminRoute('calculators'));
    }
}
