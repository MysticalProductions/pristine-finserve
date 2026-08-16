<?php

namespace App\Models;

use Core\Model;

class Subscriber extends Model
{
    protected static string $table = 'subscribers';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
