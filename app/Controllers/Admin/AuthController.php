<?php

namespace App\Controllers\Admin;

use App\Services\AuthService;
use Core\Controller;
use Core\Request;
use Core\Session;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function loginForm(Request $request): void
    {
        if ($this->session->isLoggedIn()) {
            $this->redirect(adminRoute());
        }

        $this->render('admin.auth.login');
    }

    public function login(Request $request): void
    {
        $email = $request->input('email', '');
        $password = $request->input('password', '');

        $errors = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!empty($errors)) {
            Session::instance()->flash('errors', $errors);
            Session::instance()->flash('old', $request->only(['email']));
            $this->back();
            return;
        }

        if ($this->authService->login($email, $password)) {
            $this->redirect(adminRoute());
        }

        Session::instance()->flash('error', 'Invalid email or password.');
        Session::instance()->flash('old', $request->only(['email']));
        $this->back();
    }

    public function logout(Request $request): void
    {
        $this->authService->logout();
        $this->redirect(adminRoute('login'));
    }
}
