<?php

namespace App\Models;

use Core\Model;

class Team extends Model
{
    protected static string $table = 'team';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
