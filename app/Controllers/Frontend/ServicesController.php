<?php

namespace App\Controllers\Frontend;

use App\Models\Service;
use Core\Controller;
use Core\Request;
use Core\Response;

class ServicesController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Service::db()->getPrefix();

        $services = Service::db()->fetchAll(
            "SELECT * FROM {$prefix}services WHERE status = 'published' ORDER BY `order` ASC"
        );

        $this->render('frontend.services', compact('services'));
    }

    public function show(Request $request, string $slug): void
    {
        $service = Service::whereFirst('slug', '=', $slug);

        if (!$service) {
            Response::status(404);
            $this->render('frontend.errors.404');
            return;
        }

        $this->render('frontend.service-detail', compact('service'));
    }
}
