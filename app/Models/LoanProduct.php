<?php

namespace App\Models;

use Core\Model;

class LoanProduct extends Model
{
    protected static string $table = 'loan_products';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'eligibility' => 'json',
            'documents' => 'json',
            'features' => 'json',
            'benefits' => 'json',
            'faq' => 'json',
        ];
    }
}
