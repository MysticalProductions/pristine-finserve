<?php

namespace App\Models;

use Core\Model;

class ContactInquiry extends Model
{
    protected static string $table = 'contact_inquiries';

    public function casts(): array
    {
        return [
            'id' => 'int',
            'is_read' => 'bool',
        ];
    }
}
