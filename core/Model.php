<?php

namespace Core;

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';
    protected static array $fillable = [];
    protected static array $casts = [];

    public static function db(): Database
    {
        return Database::instance();
    }

    public static function all(array $orderBy = []): array
    {
        $order = '';
        if ($orderBy) {
            $order = " ORDER BY {$orderBy[0]} {$orderBy[1]}";
        }
        return static::db()->fetchAll("SELECT * FROM " . static::table() . $order);
    }

    public static function find(int|string $id): ?object
    {
        return static::db()->fetch(
            "SELECT * FROM " . static::table() . " WHERE " . static::$primaryKey . " = :id",
            ['id' => $id]
        );
    }

    public static function where(string $column, string $operator, mixed $value): array
    {
        return static::db()->fetchAll(
            "SELECT * FROM " . static::table() . " WHERE {$column} {$operator} :value",
            ['value' => $value]
        );
    }

    public static function whereFirst(string $column, string $operator, mixed $value): ?object
    {
        return static::db()->fetch(
            "SELECT * FROM " . static::table() . " WHERE {$column} {$operator} :value LIMIT 1",
            ['value' => $value]
        );
    }

    public static function create(array $data): int
    {
        $filtered = array_intersect_key($data, array_flip(static::$fillable));
        return static::db()->insert(static::table(), static::castData($filtered));
    }

    public static function updateRecord(int|string $id, array $data): int
    {
        $filtered = array_intersect_key($data, array_flip(static::$fillable));
        return static::db()->update(
            static::table(),
            static::castData($filtered),
            static::$primaryKey . ' = :id',
            ['id' => $id]
        );
    }

    public static function deleteRecord(int|string $id): int
    {
        return static::db()->delete(static::table(), static::$primaryKey . ' = :id', ['id' => $id]);
    }

    public static function count(string $where = '', array $params = []): int
    {
        $sql = "SELECT COUNT(*) as count FROM " . static::table();
        if ($where) $sql .= " WHERE {$where}";
        $result = static::db()->fetch($sql, $params);
        return $result ? (int) $result->count : 0;
    }

    public static function paginate(int $page = 1, int $perPage = 10, string $where = '', array $params = [], string $orderBy = ''): object
    {
        $offset = ($page - 1) * $perPage;
        $whereClause = $where ? "WHERE {$where}" : '';
        $orderClause = $orderBy ? "ORDER BY {$orderBy}" : '';

        $total = static::count($where, $params);
        $items = static::db()->fetchAll(
            "SELECT * FROM " . static::table() . " {$whereClause} {$orderClause} LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        return (object) [
            'items' => $items,
            'total' => $total,
            'page' => $page,
            'perPage' => $perPage,
            'lastPage' => max(1, ceil($total / $perPage))
        ];
    }

    public static function table(): string
    {
        $ref = new \ReflectionClass(static::class);
        if (isset(static::$table)) {
            return static::db()->getPrefix() . static::$table;
        }
        $name = $ref->getShortName();
        $tableName = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $name)) . 's';
        return static::db()->getPrefix() . $tableName;
    }

    protected static function castData(array $data): array
    {
        foreach ($data as $key => $value) {
            if (isset(static::$casts[$key])) {
                $data[$key] = match (static::$casts[$key]) {
                    'json' => is_string($value) ? $value : json_encode($value),
                    'int' => (int) $value,
                    'float' => (float) $value,
                    'bool' => (bool) $value,
                    default => $value
                };
            }
        }
        return $data;
    }
}
