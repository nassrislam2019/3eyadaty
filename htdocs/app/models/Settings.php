<?php
class Settings
{
    public static function all(): array
    {
        return DB::conn()->query('SELECT * FROM settings')->fetchAll();
    }

    public static function get(string $key, $default = null)
    {
        $stmt = DB::conn()->prepare('SELECT value FROM settings WHERE `key` = ? LIMIT 1');
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }
}
