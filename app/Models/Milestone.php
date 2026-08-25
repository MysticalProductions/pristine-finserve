<?php

namespace App\Models;

use Core\Model;

class Milestone extends Model
{
    protected static string $table = 'milestones';

    public function casts(): array
    {
        return [
            'id' => 'int',
        ];
    }
}
