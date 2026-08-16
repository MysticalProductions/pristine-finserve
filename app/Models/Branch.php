<?php

namespace App\Models;

use Core\Model;

class Branch extends Model
{
    protected static string $table = 'branches';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
