<?php

namespace App\Controllers\Frontend;

use App\Models\Gallery;
use Core\Controller;
use Core\Database;
use Core\Request;

class GalleryController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();

        $items = Gallery::db()->fetchAll(
            "SELECT * FROM {$prefix}gallery WHERE status = 'active' ORDER BY `order` ASC, created_at DESC"
        );

        $grouped = [];
        $categories = [];

        foreach ($items as $item) {
            $type = $item->type ?? 'photo';
            $grouped[$type][] = $item;
            if (!empty($item->category) && !in_array($item->category, $categories, true)) {
                $categories[] = $item->category;
            }
        }

        sort($categories);

        $this->render('frontend.gallery', compact('items', 'grouped', 'categories'));
    }
}
