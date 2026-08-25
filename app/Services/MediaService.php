<?php

namespace App\Services;

use Core\Database;

class MediaService
{
    private Database $db;
    private string $table;
    private string $uploadDir;

    public function __construct()
    {
        $this->db = Database::instance();
        $this->table = $this->db->getPrefix() . 'media';
        $this->uploadDir = __DIR__ . '/../../public/uploads/media/';
    }

    public function upload(array $file, string $directory = ''): array|false
    {
        $allowedTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (!in_array($file['type'], $allowedTypes)) {
            return false;
        }

        if ($file['size'] > 10 * 1024 * 1024) {
            return false;
        }

        // Sanitize directory path to prevent path traversal
        $directory = preg_replace('/[^a-zA-Z0-9_\/-]/', '', $directory);
        $directory = trim($directory, '/');
        $targetDir = $this->uploadDir . ($directory ? $directory . '/' : '');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = uniqid('media_', true) . '.' . $extension;
        $filepath = $targetDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            return false;
        }

        $relativePath = 'uploads/media/' . ($directory ? $directory . '/' : '') . $filename;

        $id = $this->db->insert('media', [
            'original_name' => $file['name'],
            'filename' => $filename,
            'path' => $relativePath,
            'mime_type' => $file['type'],
            'size' => $file['size'],
            'extension' => $extension,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->getById($id);
    }

    public function delete(int $id): bool
    {
        $media = $this->getById($id);
        if (!$media) {
            return false;
        }

        $filepath = __DIR__ . '/../../public/' . $media->path;
        if (file_exists($filepath)) {
            unlink($filepath);
        }

        return $this->db->delete('media', 'id = :id', ['id' => $id]) > 0;
    }

    public function getById(int $id): ?object
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1",
            ['id' => $id]
        );
    }

    public function getAll(int $page = 1, string $type = ''): object
    {
        $perPage = 20;
        $offset = ($page - 1) * $perPage;
        $where = '';
        $params = [];

        if ($type) {
            $where = 'WHERE mime_type LIKE :type';
            $params['type'] = $type . '%';
        }

        $total = $this->db->fetch(
            "SELECT COUNT(*) as count FROM {$this->table} {$where}",
            $params
        );

        $items = $this->db->fetchAll(
            "SELECT * FROM {$this->table} {$where} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        return (object) [
            'items' => $items,
            'total' => $total ? (int) $total->count : 0,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => max(1, ceil(($total ? (int) $total->count : 0) / $perPage)),
        ];
    }
}
