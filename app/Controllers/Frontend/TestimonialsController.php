<?php

namespace App\Controllers\Frontend;

use App\Models\Testimonial;
use Core\Controller;
use Core\Request;

class TestimonialsController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Testimonial::db()->getPrefix();

        $testimonials = Testimonial::db()->fetchAll(
            "SELECT * FROM {$prefix}testimonials WHERE status = 'published' ORDER BY created_at DESC"
        );

        $stats = [
            'total' => count($testimonials),
            'averageRating' => 0,
            'byRating' => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0],
        ];

        $totalRating = 0;
        foreach ($testimonials as $testimonial) {
            $rating = (int) ($testimonial->rating ?? 0);
            if ($rating >= 1 && $rating <= 5) {
                $stats['byRating'][$rating]++;
                $totalRating += $rating;
            }
        }

        if ($stats['total'] > 0) {
            $stats['averageRating'] = round($totalRating / $stats['total'], 1);
        }

        $this->render('frontend.testimonials', compact('testimonials', 'stats'));
    }
}
