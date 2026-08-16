<?php

namespace App\Models;

use Core\Model;

class Statistic extends Model
{
    protected static string $table = 'statistics';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
