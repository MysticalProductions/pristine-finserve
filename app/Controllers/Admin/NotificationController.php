<?php

namespace App\Controllers\Admin;

use App\Services\NotificationService;
use Core\Controller;
use Core\Request;
use Core\Response;

class NotificationController extends BaseController
{
    private NotificationService $notificationService;

    public function __construct()
    {
        parent::__construct();
        $this->notificationService = new NotificationService();
    }

    public function index(Request $request): void
    {
        $user = $this->session->getUser();

        if (!$user) {
            $this->redirect(adminRoute('login'));
            return;
        }

        $page = (int) $request->input('page', 1);
        $pagination = $this->notificationService->getAll($user->id, $page);

        $this->render('admin.notifications.index', compact('pagination'));
    }

    public function markRead(Request $request, int $id): void
    {
        if (!$request->isPost()) {
            Response::json(['success' => false, 'message' => 'Method not allowed'], 405);
            return;
        }

        $result = $this->notificationService->markRead($id);

        Response::json(['success' => $result]);
    }
}
