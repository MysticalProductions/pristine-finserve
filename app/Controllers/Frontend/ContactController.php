<?php

namespace App\Controllers\Frontend;

use App\Services\NotificationService;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Response;

class ContactController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();

        $branches = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}branches WHERE status = 'active' ORDER BY `order` ASC"
        );

        $contactInfo = Database::instance()->fetchAll(
            "SELECT `key`, `value` FROM {$prefix}settings WHERE `key` LIKE 'contact_%' OR `key` IN ('site_email', 'site_phone', 'site_address')"
        );

        $settings = [];
        foreach ($contactInfo as $row) {
            $settings[$row->key] = $row->value;
        }

        $this->render('frontend.contact', compact('branches', 'settings'));
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
            'subject' => 'required|max:255',
            'message' => 'required|min:10|max:5000',
        ]);

        if (!empty($errors)) {
            $this->session->flash('errors', $errors);
            $this->session->flash('old', $request->all());
            $this->back();
            return;
        }

        $prefix = Database::instance()->getPrefix();
        $data = $request->only(['name', 'email', 'phone', 'subject', 'message']);

        Database::instance()->insert('contact_inquiries', array_merge($data, [
            'created_at' => date('Y-m-d H:i:s'),
        ]));

        $notif = new NotificationService();
        $notif->create(1, 'contact_inquiry', 'New Contact Inquiry', "New inquiry from {$data['name']} ({$data['email']})");

        $this->session->flash('success', 'Your message has been submitted successfully. We will get back to you shortly.');
        $this->back();
    }
}
