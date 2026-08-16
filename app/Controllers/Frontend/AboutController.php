<?php

namespace App\Controllers\Frontend;

use App\Models\Team;
use Core\Controller;
use Core\Database;
use Core\Request;

class AboutController extends Controller
{
    public function index(Request $request): void
    {
        $prefix = Database::instance()->getPrefix();

        $teamMembers = Team::db()->fetchAll(
            "SELECT * FROM {$prefix}team WHERE status = 'active' ORDER BY `order` ASC"
        );

        $milestones = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}milestones WHERE status = 'published' ORDER BY `order` ASC"
        );

        $values = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}values ORDER BY `order` ASC"
        );

        $statistics = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}statistics WHERE status = 'active' ORDER BY `order` ASC"
        );

        $achievements = Database::instance()->fetchAll(
            "SELECT * FROM {$prefix}achievements WHERE status = 'published' ORDER BY `order` ASC"
        );

        $this->render('frontend.about', compact(
            'teamMembers', 'milestones', 'values', 'statistics', 'achievements'
        ));
    }
}
