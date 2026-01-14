<?php
class DoctorSchedule
{
    public static function byDoctor(int $doctorId): array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM doctor_schedules WHERE doctor_id = ?');
        $stmt->execute([$doctorId]);
        return $stmt->fetchAll();
    }
}
