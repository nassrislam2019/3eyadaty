<?php
class AuditLog
{
    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO audit_logs (user_id, action, description, created_at) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['user_id'], $data['action'], $data['description'], $data['created_at']]);
        return (int)DB::conn()->lastInsertId();
    }
}
