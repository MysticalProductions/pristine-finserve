<?php

namespace App\Controllers\Frontend;

use App\Models\Page;
use Core\Controller;
use Core\Request;
use Core\Response;

class PageController extends Controller
{
    public function show(Request $request, ?string $slug = null): void
    {
        $slug = $slug ?: trim(parse_url($request->uri() ?? '', PHP_URL_PATH), '/');
        $slug = preg_replace('/\.html$/', '', $slug) ?: '';

        $page = Page::whereFirst('slug', '=', $slug);

        if (!$page || $page->status !== 'published') {
            Response::status(404);
            $this->render('frontend.errors.404');
            return;
        }

        $this->render('frontend.page', compact('page'));
    }
}
