<?php

namespace App\Models;

use Core\Model;

class SeoMeta extends Model
{
    protected static string $table = 'seo_meta';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
