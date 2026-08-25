<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class ActivityController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}activity_logs"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT a.*, u.name as user_name, u.email as user_email
             FROM {$this->prefix}activity_logs a
             LEFT JOIN {$this->prefix}users u ON u.id = a.user_id
             ORDER BY a.created_at DESC
             LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $this->render('admin.activity.index', compact('pagination'));
    }
}
