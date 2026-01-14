<?php
class BillingService
{
    public static function createBill(int $appointmentId, int $patientId, float $amount): int
    {
        $stmt = DB::conn()->prepare('INSERT INTO bills (appointment_id, patient_id, amount, status, created_at) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$appointmentId, $patientId, $amount, 'unpaid', date('Y-m-d H:i:s')]);
        return (int)DB::conn()->lastInsertId();
    }
}
