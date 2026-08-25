<?php

namespace App\Controllers\Frontend;

use App\Services\LeadService;
use App\Services\NotificationService;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Response;

class LeadController extends Controller
{
    private LeadService $leadService;
    private NotificationService $notificationService;

    public function __construct()
    {
        parent::__construct();
        $this->leadService = new LeadService();
        $this->notificationService = new NotificationService();
    }

    public function submit(Request $request): void
    {
        if (!$request->isPost()) {
            Response::json(['error' => 'Method not allowed'], 405);
            return;
        }

        $errors = $this->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|min:10|max:20',
            'loan_type' => 'required|max:100',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['name', 'email', 'phone', 'loan_type', 'message']);
        $data['loan_amount'] = $request->input('amount');
        $data['status'] = 'new';
        $data['source'] = 'website';
        $data['created_at'] = date('Y-m-d H:i:s');

        $this->leadService->create($data);

        $this->notificationService->create(1, 'lead', 'New Lead', "New loan inquiry from {$data['name']} for {$data['loan_type']}");

        $this->session->flash('success', 'Your inquiry has been submitted successfully. We will contact you shortly.');
        $this->back();
    }

    public function callbackRequest(Request $request): void
    {
        if (!$request->isPost()) {
            Response::json(['error' => 'Method not allowed'], 405);
            return;
        }

        $errors = $this->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:10|max:20',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $data = $request->only(['name', 'phone']);
        $data['status'] = 'callback_request';
        $data['source'] = 'website';
        $data['created_at'] = date('Y-m-d H:i:s');

        $this->leadService->create($data);

        $this->notificationService->create(1, 'callback_request', 'Callback Request', "Callback request from {$data['name']} ({$data['phone']})");

        $this->session->flash('success', 'We have received your callback request. We will call you shortly.');
        $this->back();
    }
}
