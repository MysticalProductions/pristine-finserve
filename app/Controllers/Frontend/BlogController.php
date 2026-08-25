<?php

namespace App\Controllers\Frontend;

use App\Models\BlogPost;
use Core\Controller;
use Core\Database;
use Core\Request;
use Core\Response;

class BlogController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();
        $page = (int) $request->input('page', 1);
        $perPage = ITEMS_PER_PAGE;

        $featuredPost = BlogPost::db()->fetch(
            "SELECT * FROM {$prefix}blog_posts WHERE status = 'published' AND is_featured = 1 ORDER BY created_at DESC LIMIT 1"
        );

        $where = "status = 'published'";
        $params = [];

        $pagination = BlogPost::paginate($page, $perPage, $where, $params, 'created_at DESC');

        $categories = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}blog_categories WHERE status = 'active' ORDER BY name ASC"
        );

        $this->render('frontend.blog', compact(
            'featuredPost', 'pagination', 'categories'
        ));
    }

    public function show(Request $request, string $slug): void
    {
        $post = BlogPost::whereFirst('slug', '=', $slug);

        if (!$post || $post->status !== 'published') {
            Response::status(404);
            $this->render('frontend.errors.404');
            return;
        }

        $relatedPosts = [];
        if (!empty($post->category_id)) {
            $prefix = BlogPost::db()->getPrefix();
            $relatedPosts = BlogPost::db()->fetchAll(
                "SELECT * FROM {$prefix}blog_posts WHERE category_id = :category_id AND id != :id AND status = 'published' ORDER BY created_at DESC LIMIT 3",
                ['category_id' => $post->category_id, 'id' => $post->id]
            );
        }

        $this->render('frontend.blog-single', compact('post', 'relatedPosts'));
    }
}
