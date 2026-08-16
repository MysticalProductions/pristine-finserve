<?php

namespace App\Models;

use Core\Model;

class Gallery extends Model
{
    protected static string $table = 'gallery';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
