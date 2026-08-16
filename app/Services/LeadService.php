<?php

namespace App\Services;

use Core\Database;

class LeadService
{
    private Database $db;
    private string $table;

    public function __construct()
    {
        $this->db = Database::instance();
        $this->table = $this->db->getPrefix() . 'leads';
    }

    public function create(array $data): int
    {
        return $this->db->insert('leads', $data);
    }

    public function getById(int $id): ?object
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1",
            ['id' => $id]
        );
    }

    public function updateStatus(int $id, string $status): bool
    {
        return $this->db->update(
            'leads',
            ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')],
            'id = :id',
            ['id' => $id]
        ) > 0;
    }

    public function addNote(int $id, string $note, int $userId): bool
    {
        $lead = $this->getById($id);
        if (!$lead) {
            return false;
        }

        $notes = [];
        if (!empty($lead->notes)) {
            $notes = is_string($lead->notes) ? json_decode($lead->notes, true) : (array) $lead->notes;
        }

        $notes[] = [
            'note' => $note,
            'user_id' => $userId,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->db->update(
            'leads',
            ['notes' => json_encode($notes)],
            'id = :id',
            ['id' => $id]
        ) > 0;
    }

    public function getRecent(int $limit = 10): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC LIMIT {$limit}"
        );
    }

    public function getByStatus(string $status): array
    {
        return $this->db->fetchAll(
            "SELECT * FROM {$this->table} WHERE status = :status ORDER BY created_at DESC",
            ['status' => $status]
        );
    }

    public function getStats(): object
    {
        $result = $this->db->fetchAll(
            "SELECT status, COUNT(*) as count FROM {$this->table} GROUP BY status"
        );

        $stats = ['total' => 0];
        foreach ($result as $row) {
            $stats[$row->status] = (int) $row->count;
            $stats['total'] += (int) $row->count;
        }

        return (object) $stats;
    }

    public function exportCsv(string $status = ''): string
    {
        $where = '';
        $params = [];
        if ($status) {
            $where = 'WHERE status = :status';
            $params['status'] = $status;
        }

        $leads = $this->db->fetchAll(
            "SELECT * FROM {$this->table} {$where} ORDER BY created_at DESC",
            $params
        );

        $output = fopen('php://temp', 'r+');

        if (!empty($leads)) {
            $headers = array_keys(get_object_vars($leads[0]));
            fputcsv($output, $headers);
        }

        foreach ($leads as $lead) {
            $row = [];
            foreach ($lead as $key => $value) {
                if ($key === 'notes' && $value) {
                    $row[] = is_string($value) ? $value : json_encode($value);
                } else {
                    $row[] = $value ?? '';
                }
            }
            fputcsv($output, $row);
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }
}
