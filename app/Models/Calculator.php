<?php

namespace App\Models;

use Core\Model;

class Calculator extends Model
{
    protected static string $table = 'calculators';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
