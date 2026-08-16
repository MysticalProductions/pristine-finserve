<?php

namespace App\Middleware;

use Core\Request;
use Core\Session;

class CsrfMiddleware
{
    public function handle(): void
    {
        $request = new Request();

        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            $token = $request->input('_token');
            $headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';

            $submittedToken = $token ?: $headerToken;

            if (empty($submittedToken)) {
                http_response_code(419);
                die('CSRF token mismatch');
            }

            $storedToken = Session::instance()->get('csrf_token');
            if (!hash_equals((string) $storedToken, $submittedToken)) {
                http_response_code(419);
                die('CSRF token mismatch');
            }
        }
    }
}
