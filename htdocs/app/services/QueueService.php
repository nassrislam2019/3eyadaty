<?php
class QueueService
{
    public static function checkIn(int $appointmentId, int $doctorId, string $date): int
    {
        $stmt = DB::conn()->prepare('SELECT MAX(queue_number) AS max_no FROM queues WHERE doctor_id = ? AND visit_date = ?');
        $stmt->execute([$doctorId, $date]);
        $row = $stmt->fetch();
        $next = (int)($row['max_no'] ?? 0) + 1;
        return Queue::create([
            'appointment_id' => $appointmentId,
            'doctor_id' => $doctorId,
            'visit_date' => $date,
            'status' => 'waiting',
            'queue_number' => $next
        ]);
    }
}
