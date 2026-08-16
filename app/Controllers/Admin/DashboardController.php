<?php

namespace App\Controllers\Admin;

use Core\Controller;
use Core\Database;
use Core\Request;

class DashboardController extends BaseController
{
    public function index(Request $request): void
    {
        $db = Database::instance();
        $prefix = $db->getPrefix();

        $leadsByStatus = $db->fetchAll(
            "SELECT status, COUNT(*) as count FROM {$prefix}leads GROUP BY status"
        );

        $leadCounts = [];
        $totalLeads = 0;
        foreach ($leadsByStatus as $row) {
            $leadCounts[$row->status] = (int) $row->count;
            $totalLeads += (int) $row->count;
        }

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}contact_inquiries");
        $totalInquiries = $result ? (int) $result->count : 0;

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}blog_posts");
        $totalBlogPosts = $result ? (int) $result->count : 0;

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}services");
        $totalServices = $result ? (int) $result->count : 0;

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}loan_products");
        $totalLoanProducts = $result ? (int) $result->count : 0;

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}partners");
        $totalPartners = $result ? (int) $result->count : 0;

        $subscribersResult = $db->fetch(
            "SELECT COUNT(*) as count FROM {$prefix}subscribers"
        );
        $totalSubscribers = $subscribersResult ? (int) $subscribersResult->count : 0;

        $recentLeads = $db->fetchAll(
            "SELECT * FROM {$prefix}leads ORDER BY created_at DESC LIMIT 5"
        );

        $recentInquiries = $db->fetchAll(
            "SELECT * FROM {$prefix}contact_inquiries ORDER BY created_at DESC LIMIT 5"
        );

        $data = compact(
            'leadCounts', 'totalLeads',
            'totalInquiries', 'totalBlogPosts', 'totalServices',
            'totalLoanProducts', 'totalSubscribers', 'totalPartners',
            'recentLeads', 'recentInquiries'
        );

        $result = $db->fetch("SELECT COUNT(*) as count FROM {$prefix}leads WHERE DATE(created_at) = CURDATE()");
        $newLeadsToday = $result ? (int) $result->count : 0;
        $data['newLeadsToday'] = $newLeadsToday;
        $data['blogPosts'] = $totalBlogPosts;
        $data['services'] = $totalServices;
        $data['partners'] = $totalPartners;
        $data['recentLeads'] = array_map(fn($v) => (array) $v, $recentLeads);
        $data['recentInquiries'] = array_map(fn($v) => (array) $v, $recentInquiries);

        $this->render('admin.dashboard.index', $data);
    }
}
