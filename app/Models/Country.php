<?php

namespace App\Models;

use Core\Model;

class Country extends Model
{
    protected static string $table = 'countries';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
