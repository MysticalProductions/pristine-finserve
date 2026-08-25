<?php

namespace App\Services;

use Core\Database;

class NotificationService
{
    private Database $db;
    private string $table;

    public function __construct()
    {
        $this->db = Database::instance();
        $this->table = $this->db->getPrefix() . 'notifications';
    }

    public function create(int $userId, string $type, string $title, string $message = '', string $link = ''): int
    {
        return $this->db->insert('notifications', [
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public function markRead(int $id): bool
    {
        return $this->db->update(
            'notifications',
            ['is_read' => 1],
            'id = :id',
            ['id' => $id]
        ) > 0;
    }

    public function getUnread(int $userId): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table}
             WHERE user_id = :user_id AND is_read = 0
             ORDER BY created_at DESC",
            ['user_id' => $userId]
        );
    }

    public function getAll(int $userId, int $page = 1): object
    {
        $perPage = 20;
        $offset = ($page - 1) * $perPage;

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->table} WHERE user_id = :user_id",
            ['user_id' => $userId]
        );

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->table}
             WHERE user_id = :user_id
             ORDER BY created_at DESC
             LIMIT {$perPage} OFFSET {$offset}",
            ['user_id' => $userId]
        );

        return (object) [
            'items' => $items,
            'total' => $total ? (int) $total->count : 0,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => max(1, ceil(($total ? (int) $total->count : 0) / $perPage)),
        ];
    }

    public function getUnreadCount(int $userId): int
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->table}
             WHERE user_id = :user_id AND is_read = 0",
            ['user_id' => $userId]
        );

        return $result ? (int) $result->count : 0;
    }

    public function notifyAdmins(string $type, string $title, string $message, string $link = ''): void
    {
        $admins = $this->db->fetchAll(
            "SELECT id FROM {$this->db->getPrefix()}users WHERE role_id <= 2 AND is_active = 1"
        );

        foreach ($admins as $admin) {
            $this->create($admin->id, $type, $title, $message, $link);
        }
    }
}
