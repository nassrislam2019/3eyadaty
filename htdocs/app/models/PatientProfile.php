<?php
class PatientProfile
{
    public static function findByUser(int $userId): ?array
    {
        $stmt = DB::conn()->prepare('SELECT * FROM patient_profiles WHERE user_id = ? LIMIT 1');
        $stmt->execute([$userId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
