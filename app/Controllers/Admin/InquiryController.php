<?php

namespace App\Controllers\Admin;

use App\Services\MailerService;
use Core\Controller;
use Core\Database;
use Core\Request;

class InquiryController extends BaseController
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
            "SELECT COUNT(*) as count FROM {$this->prefix}contact_inquiries"
        )->count ?? 0;

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->prefix}contact_inquiries ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}"
        );

        $lastPage = max(1, ceil($total / $perPage));
        $pagination = (object) compact('items', 'total', 'page', 'perPage', 'lastPage');

        $this->render('admin.inquiries.index', compact('pagination'));
    }

    public function view(Request $request, int $id): void
    {
        $inquiry = $this->db->fetch(
            "SELECT * FROM {$this->prefix}contact_inquiries WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$inquiry) {
            $this->session->flash('error', 'Inquiry not found.');
            $this->redirect(adminRoute('inquiries'));
            return;
        }

        if (!$inquiry->is_read) {
            $this->db->update('contact_inquiries', ['is_read' => 1], 'id = :id', ['id' => $id]);
        }

        $this->render('admin.inquiries.view', compact('inquiry'));
    }

    public function reply(Request $request, int $id): void
    {
        $inquiry = $this->db->fetch(
            "SELECT * FROM {$this->prefix}contact_inquiries WHERE id = :id LIMIT 1",
            ['id' => $id]
        );

        if (!$inquiry) {
            $this->session->flash('error', 'Inquiry not found.');
            $this->redirect(adminRoute('inquiries'));
            return;
        }

        $replyMessage = $request->input('reply_message', '');

        if (empty($replyMessage)) {
            $this->session->flash('error', 'Reply message is required.');
            $this->back();
            return;
        }

        $user = $this->session->getUser();
        $this->db->update('contact_inquiries', [
            'reply_message' => $replyMessage,
            'replied_at' => date('Y-m-d H:i:s'),
            'replied_by' => $user ? $user->id : 0,
            'is_read' => 1,
        ], 'id = :id', ['id' => $id]);

        $mailer = new MailerService();
        $subject = 'Re: ' . ($inquiry->subject ?? 'Your Inquiry');
        $body = "Dear {$inquiry->name},\n\n"
              . "Thank you for reaching out to us. Here is our reply to your inquiry:\n\n"
              . "---\n{$replyMessage}\n---\n\n"
              . "If you have any further questions, please don't hesitate to contact us.\n\n"
              . "Best regards,\n"
              . "Pristine Finserve Team";

        $sent = $mailer->send($inquiry->email, $subject, $body);

        $this->session->flash(
            $sent ? 'success' : 'error',
            $sent ? 'Reply sent successfully.' : 'Reply saved but email delivery failed. Check mail configuration.'
        );
        $this->redirect(adminRoute('inquiries/view/' . $id));
    }

    public function delete(Request $request, int $id): void
    {
        $this->db->delete('contact_inquiries', 'id = :id', ['id' => $id]);

        $this->session->flash('success', 'Inquiry deleted successfully.');
        $this->redirect(adminRoute('inquiries'));
    }
}
