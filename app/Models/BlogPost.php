<?php

namespace App\Models;

use Core\Model;

class BlogPost extends Model
{
    protected static string $table = 'blog_posts';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'tags' => 'json',
            'is_featured' => 'bool',
        ];
    }
}
