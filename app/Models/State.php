<?php

namespace App\Models;

use Core\Model;

class State extends Model
{
    protected static string $table = 'states';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
