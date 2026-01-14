USE 3eyadaty;

INSERT INTO users (name, email, password, role, status) VALUES
('سوبر أدمن', 'super@3eyadaty.com', '$2y$12$M/MKDEGgrB.N/bzPzCkmwOfUBLlvJ9w4A6dtRbEMyUzZ2tLz83VOm', 'super_admin', 'active'),
('مدير', 'admin@3eyadaty.com', '$2y$12$M/MKDEGgrB.N/bzPzCkmwOfUBLlvJ9w4A6dtRbEMyUzZ2tLz83VOm', 'admin', 'active'),
('د. أحمد', 'doctor@3eyadaty.com', '$2y$12$M/MKDEGgrB.N/bzPzCkmwOfUBLlvJ9w4A6dtRbEMyUzZ2tLz83VOm', 'doctor', 'active'),
('استقبال', 'reception@3eyadaty.com', '$2y$12$M/MKDEGgrB.N/bzPzCkmwOfUBLlvJ9w4A6dtRbEMyUzZ2tLz83VOm', 'receptionist', 'active'),
('محمد مريض', 'patient@3eyadaty.com', '$2y$12$M/MKDEGgrB.N/bzPzCkmwOfUBLlvJ9w4A6dtRbEMyUzZ2tLz83VOm', 'patient', 'active');

INSERT INTO patient_profiles (user_id, phone, gender, birth_date, address) VALUES
(5, '0500000001', 'male', '1995-05-10', 'الرياض');

INSERT INTO branches (name, city, address, phone) VALUES
('فرع العليا', 'الرياض', 'شارع العليا', '0110000000'),
('فرع الخبر', 'الخبر', 'طريق الملك فهد', '0130000000');

INSERT INTO specializations (name) VALUES
('باطنة'),
('جلدية'),
('أسنان');

INSERT INTO doctors (user_id, specialization_id, branch_id, name, price, experience_years, bio) VALUES
(3, 1, 1, 'د. أحمد علي', 200.00, 8, 'استشاري باطنة وخبرة في إدارة العيادات');

INSERT INTO doctor_schedules (doctor_id, day_of_week, start_time, end_time) VALUES
(1, 'الأحد', '09:00:00', '13:00:00'),
(1, 'الثلاثاء', '16:00:00', '20:00:00');

INSERT INTO cancellation_reasons (reason) VALUES
('ظرف طارئ'),
('تحسن الحالة'),
('تعديل الموعد');

INSERT INTO appointments (patient_id, doctor_id, branch_id, appointment_date, appointment_time, status, reason, cancel_reason_id) VALUES
(5, 1, 1, CURDATE(), '10:00:00', 'confirmed', 'ألم في البطن', NULL);

INSERT INTO queues (appointment_id, doctor_id, visit_date, queue_number, status) VALUES
(1, 1, CURDATE(), 1, 'waiting');

INSERT INTO medical_histories (patient_id, doctor_id, appointment_id, visit_date, complaint, diagnosis, treatment_plan, notes) VALUES
(5, 1, 1, CURDATE(), 'ألم في البطن', 'التهاب معدة', 'أدوية + راحة', 'متابعة بعد أسبوع');

INSERT INTO prescriptions (patient_id, doctor_id, appointment_id, medicine, dosage, instructions) VALUES
(5, 1, 1, 'دواء معدة', 'مرتين يومياً', 'بعد الأكل');

INSERT INTO bills (appointment_id, patient_id, doctor_id, amount, paid_amount, status) VALUES
(1, 5, 1, 200.00, 200.00, 'paid');

INSERT INTO payments (bill_id, amount, method) VALUES
(1, 200.00, 'cash');

INSERT INTO notifications (user_id, title, body) VALUES
(3, 'حجز جديد', 'تم إنشاء حجز جديد للمرضى'),
(4, 'تنبيه استقبال', 'لديك حجز جديد يحتاج تأكيد'),
(5, 'تأكيد الحجز', 'تم تأكيد حجزك بنجاح');

INSERT INTO audit_logs (user_id, action, description) VALUES
(1, 'seed', 'تهيئة قاعدة البيانات'),
(3, 'appointment_create', 'تم إنشاء حجز للمريض محمد');

INSERT INTO settings (`key`, `value`) VALUES
('app_name', '3eyadaty'),
('currency', 'SAR'),
('visit_duration', '10'),
('cancellation_hours', '6'),
('auto_confirm_appointments', '0'),
('allow_registration', '1');

INSERT INTO role_permissions (role, permission) VALUES
('admin', 'manage_doctors'),
('admin', 'manage_appointments'),
('doctor', 'view_queue'),
('receptionist', 'manage_queue'),
('patient', 'book_appointment');
