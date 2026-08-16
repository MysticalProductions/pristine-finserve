<?php

namespace App\Models;

use Core\Model;

class City extends Model
{
    protected static string $table = 'cities';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
