<?php

namespace App\Models;

use Core\Model;

class EmailTemplate extends Model
{
    protected static string $table = 'email_templates';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
