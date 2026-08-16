<?php

namespace App\Models;

use Core\Model;

class Menu extends Model
{
    protected static string $table = 'menus';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'items' => 'json',
        ];
    }
}
