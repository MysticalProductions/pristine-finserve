<?php

namespace App\Models;

use Core\Model;

class Testimonial extends Model
{
    protected static string $table = 'testimonials';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'rating' => 'int',
            'is_featured' => 'bool',
        ];
    }
}
