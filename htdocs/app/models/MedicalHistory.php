<?php
class MedicalHistory
{
    public static function byPatient(int $patientId): array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM medical_histories WHERE patient_id = ? ORDER BY visit_date DESC');
        $stmt->execute([$patientId]);
        return $stmt->fetchAll();
    }
}
