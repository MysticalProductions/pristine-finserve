<?php

namespace App\Models;

use Core\Model;

class Document extends Model
{
    protected static string $table = 'documents';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
