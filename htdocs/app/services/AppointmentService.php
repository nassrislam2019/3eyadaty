<?php
class AppointmentService
{
    public static function book(array $data): int
    {
        $status = Settings::get('auto_confirm_appointments', '0') === '1' ? 'confirmed' : 'pending';
        $appointmentId = Appointment::create([
            'patient_id' => $data['patient_id'],
            'doctor_id' => $data['doctor_id'],
            'branch_id' => $data['branch_id'],
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'status' => $status,
            'reason' => $data['reason'] ?? ''
        ]);

        AuditLog::create([
            'user_id' => $data['user_id'],
            'action' => 'appointment_create',
            'description' => 'تم إنشاء حجز جديد رقم ' . $appointmentId,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach ($data['notify_user_ids'] as $userId) {
            Notification::create([
                'user_id' => $userId,
                'title' => 'حجز جديد',
                'body' => 'تم إنشاء حجز جديد بتاريخ ' . $data['appointment_date'],
                'is_read' => 0
            ]);
        }

        return $appointmentId;
    }
}
