<?php
class ReportService
{
    public static function appointmentSummary(array $filters): array
    {
        $sql = 'SELECT status, COUNT(*) AS total FROM appointments WHERE 1=1';
        $params = [];
        if (!empty($filters['doctor_id'])) {
            $sql .= ' AND doctor_id = ?';
            $params[] = $filters['doctor_id'];
        }
        if (!empty($filters['from'])) {
            $sql .= ' AND appointment_date >= ?';
            $params[] = $filters['from'];
        }
        if (!empty($filters['to'])) {
            $sql .= ' AND appointment_date <= ?';
            $params[] = $filters['to'];
        }
        $sql .= ' GROUP BY status';
        $stmt = DB::conn()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function revenueSummary(array $filters): array
    {
        $sql = 'SELECT SUM(amount) AS total_amount, SUM(paid_amount) AS total_paid FROM bills WHERE 1=1';
        $params = [];
        if (!empty($filters['doctor_id'])) {
            $sql .= ' AND doctor_id = ?';
            $params[] = $filters['doctor_id'];
        }
        if (!empty($filters['from'])) {
            $sql .= ' AND created_at >= ?';
            $params[] = $filters['from'];
        }
        if (!empty($filters['to'])) {
            $sql .= ' AND created_at <= ?';
            $params[] = $filters['to'];
        }
        $stmt = DB::conn()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch() ?: ['total_amount' => 0, 'total_paid' => 0];
    }
}
