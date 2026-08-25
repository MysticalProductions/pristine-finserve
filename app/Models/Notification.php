<?php

namespace App\Models;

use Core\Model;

class Notification extends Model
{
    protected static string $table = 'notifications';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'is_read' => 'bool',
        ];
    }
}
