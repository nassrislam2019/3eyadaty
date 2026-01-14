<?php
class Prescription
{
    public static function byPatient(int $patientId): array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM prescriptions WHERE patient_id = ? ORDER BY created_at DESC');
        $stmt->execute([$patientId]);
        return $stmt->fetchAll();
    }
}
