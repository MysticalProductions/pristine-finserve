<?php

namespace App\Controllers\Admin;

use App\Services\LeadService;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Response;

class LeadController extends BaseController
{
    private LeadService $leadService;
    private Database $db;
    private string $prefix;

    public function __construct()
    {
        parent::__construct();
        $this->leadService = new LeadService();
        $this->db = Database::instance();
        $this->prefix = $this->db->getPrefix();
    }

    public function index(Request $request): void
    {
        $page = (int) $request->input('page', 1);
        $perPage = ITEMS_PER_PAGE;
        $offset = ($page - 1) * $perPage;
        $status = $request->input('status', '');

        $where = '';
        $params = [];

        if ($status) {
            $where = "WHERE status = :status";
            $params['status'] = $status;
        }

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->prefix}leads {$where}",
            $params
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}leads {$where} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $statuses = $this->db->fetchAll(
            "SELECT DISTINCT status FROM {$this->prefix}leads ORDER BY status ASC"
        );

        $this->render('admin.leads.index', compact('pagination', 'status', 'statuses'));
    }

    public function view(Request $request, int $id): void
    {
        $lead = $this->leadService->getById($id);

        if (!$lead) {
            $this->session->flash('error', 'Lead not found.');
            $this->redirect(adminRoute('leads'));
            return;
        }

        $this->render('admin.leads.view', compact('lead'));
    }

    public function updateStatus(Request $request, int $id): void
    {
        $status = $request->input('status', '');

        if (!$status) {
            $this->session->flash('error', 'Status is required.');
            $this->back();
            return;
        }

        $this->leadService->updateStatus($id, $status);

        $this->session->flash('success', 'Lead status updated successfully.');
        $this->back();
    }

    public function addNote(Request $request, int $id): void
    {
        $note = $request->input('note', '');
        $user = $this->session->getUser();

        if (!$note) {
            $this->session->flash('error', 'Note is required.');
            $this->back();
            return;
        }

        $this->leadService->addNote($id, $note, $user->id ?? 0);

        $this->session->flash('success', 'Note added successfully.');
        $this->back();
    }

    public function export(Request $request): void
    {
        $status = $request->input('status', '');
        $csv = $this->leadService->exportCsv($status);

        $filename = 'leads-' . date('Y-m-d-His') . '.csv';

        Response::setHeaders([
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Content-Length' => strlen($csv),
        ]);

        echo $csv;
        exit;
    }
}
