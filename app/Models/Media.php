<?php

namespace App\Models;

use Core\Model;

class Media extends Model
{
    protected static string $table = 'media';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
