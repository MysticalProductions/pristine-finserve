<?php

namespace App\Models;

use Core\Model;

class Partner extends Model
{
    protected static string $table = 'partners';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
