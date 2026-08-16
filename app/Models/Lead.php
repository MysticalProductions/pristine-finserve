<?php

namespace App\Models;

use Core\Model;

class Lead extends Model
{
    protected static string $table = 'leads';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'notes' => 'json',
            'loan_amount' => 'float',
        ];
    }
}
