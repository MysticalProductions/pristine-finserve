<?php

namespace App\Models;

use Core\Model;

class LoanApplication extends Model
{
    protected static string $table = 'loan_applications';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
