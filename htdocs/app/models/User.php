<?php
class User
{
    public static function findByEmail(string $email): ?array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function findById(int $id): ?array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM users WHERE id = ? LIMIT 1');
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public static function all(): array
    {
        return DB::conn()->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();
    }

    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$data['name'], $data['email'], $data['password'], $data['role'], $data['status']]);
        return (int)DB::conn()->lastInsertId();
    }
}
