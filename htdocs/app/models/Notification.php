<?php
class Notification
{
    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO notifications (user_id, title, body, is_read) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['user_id'], $data['title'], $data['body'], $data['is_read']]);
        return (int)DB::conn()->lastInsertId();
    }
}
