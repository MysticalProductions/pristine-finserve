<?php

namespace App\Models;

use Core\Model;

class Value extends Model
{
    protected static string $table = 'values';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
