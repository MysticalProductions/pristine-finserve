<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class StatisticsController extends BaseController
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
        $statistics = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}statistics ORDER BY `order` ASC"
        );

        $this->render('admin.statistics.index', compact('statistics'));
    }

    public function create(Request $request): void
    {
        $this->render('admin.statistics.create');
    }

    public function store(Request $request): void
    {
        $errors = $this->validate([
            'label' => 'required|max:100',
            'value' => 'required|max:50',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['label', 'value', 'suffix', 'icon', 'status', 'order']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!isset($data['status'])) $data['status'] = 'active';
        if (!isset($data['order'])) $data['order'] = 0;
        if (!isset($data['suffix'])) $data['suffix'] = '+';
        if (!isset($data['icon'])) $data['icon'] = '📊';

        $this->db->insert('statistics', $data);

        $this->session->flash('success', 'Statistic created successfully.');
        $this->redirect(adminRoute('statistics'));
    }

    public function edit(Request $request, int $id): void
    {
        $statistic = $this->db->fetch(
            "SELECT * FROM {$this->prefix}statistics WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$statistic) {
            $this->session->flash('error', 'Statistic not found.');
            $this->redirect(adminRoute('statistics'));
            return;
        }

        $this->render('admin.statistics.edit', ['statistic' => (array) $statistic]);
    }

    public function update(Request $request, int $id): void
    {
        $errors = $this->validate([
            'label' => 'required|max:100',
            'value' => 'required|max:50',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->back();
            return;
        }

        $data = $request->only(['label', 'value', 'suffix', 'icon', 'status', 'order']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!isset($data['suffix'])) $data['suffix'] = '+';
        if (!isset($data['order'])) $data['order'] = 0;

        $this->db->update('statistics', $data, 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Statistic updated successfully.');
        $this->redirect(adminRoute('statistics'));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('statistics', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Statistic deleted successfully.');
        $this->redirect(adminRoute('statistics'));
    }
}
