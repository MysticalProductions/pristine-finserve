<?php

namespace App\Models;

use Core\Model;

class Page extends Model
{
    protected static string $table = 'pages';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'show_in_menu' => 'bool',
            'menu_order' => 'int',
        ];
    }
}
