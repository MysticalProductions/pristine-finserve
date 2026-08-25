<?php

namespace App\Models;

use Core\Model;

class BlogCategory extends Model
{
    protected static string $table = 'blog_categories';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
