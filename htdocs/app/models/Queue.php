<?php
class Queue
{
    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO queues (appointment_id, doctor_id, visit_date, status, queue_number) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['appointment_id'],
            $data['doctor_id'],
            $data['visit_date'],
            $data['status'],
            $data['queue_number']
        ]);
        return (int)DB::conn()->lastInsertId();
    }

    public static function byDoctorToday(int $doctorId, string $date): array
    {
        $stmt = DB::conn()->prepare('SELECT q.*, a.patient_id FROM queues q JOIN appointments a ON a.id = q.appointment_id WHERE q.doctor_id = ? AND q.visit_date = ? ORDER BY q.queue_number');
        $stmt->execute([$doctorId, $date]);
        return $stmt->fetchAll();
    }
}
