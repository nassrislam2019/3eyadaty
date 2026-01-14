<?php
class Bill
{
    public static function byPatient(int $patientId): array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM bills WHERE patient_id = ? ORDER BY created_at DESC');
        $stmt->execute([$patientId]);
        return $stmt->fetchAll();
    }
}
