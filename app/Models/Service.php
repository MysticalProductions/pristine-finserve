<?php

namespace App\Models;

use Core\Model;

class Service extends Model
{
    protected static string $table = 'services';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'features' => 'json',
            'process' => 'json',
            'benefits' => 'json',
            'faq' => 'json',
        ];
    }
}
