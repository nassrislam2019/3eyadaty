<?php
class Payment
{
    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO payments (bill_id, amount, method, paid_at) VALUES (?, ?, ?, ?)');
        $stmt->execute([$data['bill_id'], $data['amount'], $data['method'], $data['paid_at']]);
        return (int)DB::conn()->lastInsertId();
    }
}
