<?php
class Appointment
{
    public static function create(array $data): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO appointments (patient_id, doctor_id, branch_id, appointment_date, appointment_time, status, reason) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['patient_id'],
            $data['doctor_id'],
            $data['branch_id'],
            $data['appointment_date'],
            $data['appointment_time'],
            $data['status'],
            $data['reason']
        ]);
        return (int)DB::conn()->lastInsertId();
    }

    public static function byPatient(int $patientId): array
    {
        $stmt = DB::conn()->prepare('SELECT a.*, d.name AS doctor_name FROM appointments a JOIN doctors d ON d.id = a.doctor_id WHERE a.patient_id = ? ORDER BY a.appointment_date DESC');
        $stmt->execute([$patientId]);
        return $stmt->fetchAll();
    }
}
