<?php

namespace App\Models;

use Core\Model;

class Faq extends Model
{
    protected static string $table = 'faqs';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
