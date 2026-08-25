<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Session;

abstract class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->layout = 'admin.layouts.admin';
    }

    protected function render(string $template, array $data = []): void
    {
        $session = Session::instance();
        $user = $session->getUser();

        $data['currentUser'] = $user ? (array) $user : [];
        $data['unreadNotifications'] = 0;

        if ($user && isset($user->id)) {
            $notifService = new \App\Services\NotificationService();
            $data['unreadNotifications'] = $notifService->getUnreadCount($user->id);
        }

        parent::render($template, $data);
    }
}
