<?php

namespace App\Models;

use Core\Model;

class Achievement extends Model
{
    protected static string $table = 'achievements';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
