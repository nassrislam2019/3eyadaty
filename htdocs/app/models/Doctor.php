<?php
class Doctor
{
    public static function all(): array
    {
        $sql = 'SELECT d.*, s.name AS specialization_name, b.name AS branch_name FROM doctors d
                JOIN specializations s ON s.id = d.specialization_id
                JOIN branches b ON b.id = d.branch_id
                ORDER BY d.id DESC';
        return DB::conn()->query($sql)->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = DB::conn()->prepare('SELECT d.*, s.name AS specialization_name, b.name AS branch_name FROM doctors d
            JOIN specializations s ON s.id = d.specialization_id
            JOIN branches b ON b.id = d.branch_id
            WHERE d.id = ? LIMIT 1');
        $stmt->execute([$id]);
        $doctor = $stmt->fetch();
        return $doctor ?: null;
    }

    public static function schedules(int $doctorId): array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM doctor_schedules WHERE doctor_id = ? ORDER BY day_of_week, start_time');
        $stmt->execute([$doctorId]);
        return $stmt->fetchAll();
    }
}
