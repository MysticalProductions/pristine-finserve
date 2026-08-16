<?php

namespace App\Models;

use Core\Model;

class ActivityLog extends Model
{
    protected static string $table = 'activity_logs';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
