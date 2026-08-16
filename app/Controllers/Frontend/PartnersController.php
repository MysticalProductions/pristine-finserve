<?php

namespace App\Controllers\Frontend;

use App\Models\Partner;
use Core\Controller;
use Core\Request;

class PartnersController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Partner::db()->getPrefix();

        $partners = Partner::db()->fetchAll(
            "SELECT * FROM {$prefix}partners WHERE status = 'active' ORDER BY `order` ASC"
        );

        $grouped = [];
        foreach ($partners as $partner) {
            $type = $partner->type ?? 'general';
            $grouped[$type][] = $partner;
        }

        $this->render('frontend.partners', compact('partners', 'grouped'));
    }
}
