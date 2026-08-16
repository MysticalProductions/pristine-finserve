<?php

namespace App\Controllers\Frontend;

use App\Models\BlogPost;
use App\Models\LoanProduct;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Testimonial;
use Core\Controller;
use Core\Database;
use Core\Request;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();

        $services = Service::db()->fetchAll(
            "SELECT * FROM {$prefix}services WHERE status = 'published' ORDER BY `order` ASC LIMIT 6"
        );

        $loanProducts = LoanProduct::db()->fetchAll(
            "SELECT * FROM {$prefix}loan_products WHERE status = 'published' ORDER BY `order` ASC LIMIT 6"
        );

        $blogPosts = BlogPost::db()->fetchAll(
            "SELECT * FROM {$prefix}blog_posts WHERE status = 'published' ORDER BY published_at DESC, created_at DESC LIMIT 3"
        );

        $testimonials = Testimonial::db()->fetchAll(
            "SELECT * FROM {$prefix}testimonials WHERE status = 'published' AND is_featured = 1 ORDER BY created_at DESC"
        );

        $statistics = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}statistics WHERE status = 'active' ORDER BY `order` ASC"
        );

        $partners = Partner::where('status', '=', 'active');

        $this->render('frontend.home', compact(
            'services', 'loanProducts', 'blogPosts', 'testimonials',
            'statistics', 'partners'
        ));
    }
}
