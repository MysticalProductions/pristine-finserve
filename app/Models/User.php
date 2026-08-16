<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected static string $table = 'users';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'role_id' => 'int',
            'last_login' => 'string',
        ];
    }
}
