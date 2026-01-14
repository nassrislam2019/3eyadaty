<?php
class NotificationService
{
    public static function send(int $userId, string $title, string $body): int
    {
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'body' => $body,
            'is_read' => 0
        ]);
    }
}
