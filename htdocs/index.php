<?php
$config = require __DIR__ . '/config/app.php';
date_default_timezone_set($config['timezone']);
session_name($config['session_name']);
session_start();

require __DIR__ . '/app/core/DB.php';
require __DIR__ . '/app/core/Helpers.php';
require __DIR__ . '/app/core/CSRF.php';
require __DIR__ . '/app/core/Auth.php';
require __DIR__ . '/app/core/Response.php';
require __DIR__ . '/app/core/Middleware.php';
require __DIR__ . '/app/core/Router.php';
require __DIR__ . '/app/core/Validator.php';
require __DIR__ . '/app/core/Uploader.php';

require __DIR__ . '/app/models/User.php';
require __DIR__ . '/app/models/Doctor.php';
require __DIR__ . '/app/models/PatientProfile.php';
require __DIR__ . '/app/models/Specialization.php';
require __DIR__ . '/app/models/Branch.php';
require __DIR__ . '/app/models/DoctorSchedule.php';
require __DIR__ . '/app/models/Appointment.php';
require __DIR__ . '/app/models/Queue.php';
require __DIR__ . '/app/models/MedicalHistory.php';
require __DIR__ . '/app/models/Prescription.php';
require __DIR__ . '/app/models/Bill.php';
require __DIR__ . '/app/models/Payment.php';
require __DIR__ . '/app/models/Notification.php';
require __DIR__ . '/app/models/AuditLog.php';
require __DIR__ . '/app/models/Settings.php';

require __DIR__ . '/app/services/AppointmentService.php';
require __DIR__ . '/app/services/QueueService.php';
require __DIR__ . '/app/services/BillingService.php';
require __DIR__ . '/app/services/NotificationService.php';
require __DIR__ . '/app/services/ReportService.php';

$router = new Router();

$route = $_GET['route'] ?? trim($_SERVER['PATH_INFO'] ?? '', '/');
$route = $route === '' ? 'home' : $route;

$router->add('GET', 'home', function () use ($config) {
    $stats = [
        'doctors' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM doctors')->fetch()['total'],
        'patients' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM patient_profiles')->fetch()['total'],
        'appointments' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM appointments')->fetch()['total'],
    ];
    $latestDoctors = array_slice(Doctor::all(), 0, 6);
    $specializations = Specialization::all();
    Response::view('public/home', [
        'title' => 'الرئيسية',
        'stats' => $stats,
        'latestDoctors' => $latestDoctors,
        'specializations' => $specializations,
        'currency' => $config['currency'],
    ]);
});

$router->add('GET', 'public/doctors', function () use ($config) {
    $specializations = Specialization::all();
    $branches = Branch::all();
    $doctors = Doctor::all();
    Response::view('public/doctors', [
        'title' => 'الأطباء',
        'doctors' => $doctors,
        'specializations' => $specializations,
        'branches' => $branches,
        'currency' => $config['currency'],
    ]);
});

$router->add('GET', 'public/doctor_view', function () use ($config) {
    $id = (int)($_GET['id'] ?? 0);
    $doctor = Doctor::find($id);
    $schedules = $doctor ? Doctor::schedules($id) : [];
    Response::view('public/doctor_view', [
        'title' => 'ملف الطبيب',
        'doctor' => $doctor,
        'schedules' => $schedules,
        'currency' => $config['currency'],
    ]);
});

$router->add('GET', 'login', function () {
    Response::view('public/login', ['title' => 'تسجيل الدخول']);
});

$router->add('POST', 'login', function () {
    if (!CSRF::check($_POST['csrf_token'] ?? null)) {
        Helpers::flash('error', 'رمز التحقق غير صالح');
        Helpers::redirect('index.php?route=login');
    }
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $user = User::findByEmail($email);
    if (!$user || !password_verify($password, $user['password'])) {
        Helpers::flash('error', 'بيانات الدخول غير صحيحة');
        Helpers::redirect('index.php?route=login');
    }
    Auth::login($user);
    Helpers::redirect('index.php?route=home');
});

$router->add('GET', 'register', function () {
    Response::view('public/register', ['title' => 'تسجيل جديد']);
});

$router->add('POST', 'register', function () {
    if (!CSRF::check($_POST['csrf_token'] ?? null)) {
        Helpers::flash('error', 'رمز التحقق غير صالح');
        Helpers::redirect('index.php?route=register');
    }
    if (Settings::get('allow_registration', '1') !== '1') {
        Helpers::flash('error', 'التسجيل مغلق حالياً');
        Helpers::redirect('index.php?route=register');
    }
    $errors = Validator::required($_POST, ['name', 'email', 'phone', 'password']);
    if ($errors) {
        Helpers::flash('error', 'يرجى تعبئة الحقول المطلوبة');
        Helpers::redirect('index.php?route=register');
    }
    $userId = User::create([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'role' => 'patient',
        'status' => 'active'
    ]);
    $stmt = DB::conn()->prepare('INSERT INTO patient_profiles (user_id, phone) VALUES (?, ?)');
    $stmt->execute([$userId, $_POST['phone']]);
    Helpers::flash('success', 'تم إنشاء الحساب بنجاح');
    Helpers::redirect('index.php?route=login');
});

$router->add('GET', 'logout', function () {
    Auth::logout();
    Helpers::redirect('index.php?route=home');
});

$router->add('GET', 'notifications', function () {
    $userId = Auth::user()['id'] ?? 0;
    $notifications = [];
    if ($userId) {
        $stmt = DB::conn()->prepare('SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        $notifications = $stmt->fetchAll();
    }
    Response::view('public/notifications', ['title' => 'الإشعارات', 'notifications' => $notifications]);
}, ['super_admin', 'admin', 'doctor', 'receptionist', 'patient']);

$router->add('GET', 'admin/dashboard', function () use ($config) {
    $stats = [
        'appointments' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM appointments')->fetch()['total'],
        'patients' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM patient_profiles')->fetch()['total'],
        'doctors' => (int)DB::conn()->query('SELECT COUNT(*) AS total FROM doctors')->fetch()['total'],
        'revenue' => (float)DB::conn()->query('SELECT SUM(amount) AS total FROM bills')->fetch()['total'],
    ];
    Response::view('admin/dashboard', ['title' => 'لوحة التحكم', 'stats' => $stats, 'currency' => $config['currency']]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/users', function () {
    Response::view('admin/users', ['title' => 'المستخدمون', 'users' => User::all()]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/roles', function () {
    Response::view('admin/roles', ['title' => 'الأدوار']);
}, ['super_admin']);

$router->add('GET', 'admin/doctors', function () {
    Response::view('admin/doctors', ['title' => 'الأطباء', 'doctors' => Doctor::all()]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/schedules', function () {
    $sql = 'SELECT ds.*, d.name AS doctor_name FROM doctor_schedules ds JOIN doctors d ON d.id = ds.doctor_id';
    $schedules = DB::conn()->query($sql)->fetchAll();
    Response::view('admin/schedules', ['title' => 'الجداول', 'schedules' => $schedules]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/branches', function () {
    Response::view('admin/branches', ['title' => 'الفروع', 'branches' => Branch::all()]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/specializations', function () {
    Response::view('admin/specializations', ['title' => 'التخصصات', 'specializations' => Specialization::all()]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/appointments', function () {
    $sql = 'SELECT a.*, u.name AS patient_name, d.name AS doctor_name FROM appointments a
        JOIN users u ON u.id = a.patient_id
        JOIN doctors d ON d.id = a.doctor_id ORDER BY a.appointment_date DESC';
    $appointments = DB::conn()->query($sql)->fetchAll();
    Response::view('admin/appointments', ['title' => 'الحجوزات', 'appointments' => $appointments]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/queue', function () {
    $sql = 'SELECT q.*, d.name AS doctor_name FROM queues q JOIN doctors d ON d.id = q.doctor_id';
    $queues = DB::conn()->query($sql)->fetchAll();
    Response::view('admin/queue', ['title' => 'الدور', 'queues' => $queues]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/bills', function () {
    $sql = 'SELECT b.*, u.name AS patient_name FROM bills b JOIN users u ON u.id = b.patient_id';
    $bills = DB::conn()->query($sql)->fetchAll();
    Response::view('admin/bills', ['title' => 'الفواتير', 'bills' => $bills]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/reports', function () use ($config) {
    $appointmentSummary = ReportService::appointmentSummary([]);
    $revenueSummary = ReportService::revenueSummary([]);
    Response::view('admin/reports', [
        'title' => 'التقارير',
        'appointmentSummary' => $appointmentSummary,
        'revenueSummary' => $revenueSummary,
        'currency' => $config['currency']
    ]);
}, ['super_admin', 'admin']);

$router->add('GET', 'admin/settings', function () {
    $settingsRows = Settings::all();
    $settings = [];
    foreach ($settingsRows as $row) {
        $settings[$row['key']] = $row['value'];
    }
    Response::view('admin/settings', ['title' => 'الإعدادات', 'settings' => $settings]);
}, ['super_admin', 'admin']);

$router->add('POST', 'admin/settings', function () {
    if (!CSRF::check($_POST['csrf_token'] ?? null)) {
        Helpers::flash('error', 'رمز التحقق غير صالح');
        Helpers::redirect('index.php?route=admin/settings');
    }
    $updates = [
        'app_name' => $_POST['app_name'] ?? '',
        'visit_duration' => $_POST['visit_duration'] ?? '',
        'cancellation_hours' => $_POST['cancellation_hours'] ?? '',
        'allow_registration' => $_POST['allow_registration'] ?? '0'
    ];
    foreach ($updates as $key => $value) {
        $stmt = DB::conn()->prepare('UPDATE settings SET value = ? WHERE `key` = ?');
        $stmt->execute([$value, $key]);
    }
    Helpers::flash('success', 'تم تحديث الإعدادات');
    Helpers::redirect('index.php?route=admin/settings');
}, ['super_admin', 'admin']);

$router->add('GET', 'doctor/dashboard', function () {
    Response::view('doctor/dashboard', ['title' => 'لوحة الطبيب', 'stats' => ['today' => 0, 'completed' => 0, 'queue' => '-']]);
}, ['doctor']);

$router->add('GET', 'doctor/my_schedule', function () {
    $user = Auth::user();
    $doctor = DB::conn()->prepare('SELECT id FROM doctors WHERE user_id = ?');
    $doctor->execute([$user['id']]);
    $docId = (int)($doctor->fetch()['id'] ?? 0);
    $schedules = DoctorSchedule::byDoctor($docId);
    Response::view('doctor/my_schedule', ['title' => 'جدولي', 'schedules' => $schedules]);
}, ['doctor']);

$router->add('GET', 'doctor/my_appointments', function () {
    $user = Auth::user();
    $doctor = DB::conn()->prepare('SELECT id FROM doctors WHERE user_id = ?');
    $doctor->execute([$user['id']]);
    $docId = (int)($doctor->fetch()['id'] ?? 0);
    $sql = 'SELECT a.*, u.name AS patient_name FROM appointments a JOIN users u ON u.id = a.patient_id WHERE a.doctor_id = ?';
    $stmt = DB::conn()->prepare($sql);
    $stmt->execute([$docId]);
    $appointments = $stmt->fetchAll();
    Response::view('doctor/my_appointments', ['title' => 'مواعيدي', 'appointments' => $appointments]);
}, ['doctor']);

$router->add('GET', 'doctor/appointment_view', function () {
    Response::view('doctor/appointment_view', ['title' => 'تفاصيل الموعد', 'appointment' => []]);
}, ['doctor']);

$router->add('GET', 'doctor/prescriptions', function () {
    Response::view('doctor/prescriptions', ['title' => 'الوصفات', 'prescriptions' => []]);
}, ['doctor']);

$router->add('GET', 'doctor/patient_history', function () {
    Response::view('doctor/patient_history', ['title' => 'السجل الطبي', 'histories' => []]);
}, ['doctor']);

$router->add('GET', 'doctor/queue', function () {
    Response::view('doctor/queue', ['title' => 'الدور', 'queues' => []]);
}, ['doctor']);

$router->add('GET', 'reception/dashboard', function () {
    Response::view('reception/dashboard', ['title' => 'لوحة الاستقبال', 'stats' => ['today' => 0, 'waiting' => 0, 'completed' => 0]]);
}, ['receptionist']);

$router->add('GET', 'reception/appointments', function () {
    Response::view('reception/appointments', ['title' => 'الحجوزات', 'appointments' => []]);
}, ['receptionist']);

$router->add('GET', 'reception/queue', function () {
    Response::view('reception/queue', ['title' => 'الدور', 'queues' => []]);
}, ['receptionist']);

$router->add('GET', 'reception/patients', function () {
    $patients = DB::conn()->query('SELECT u.name, u.email, p.phone FROM patient_profiles p JOIN users u ON u.id = p.user_id')->fetchAll();
    Response::view('reception/patients', ['title' => 'المرضى', 'patients' => $patients]);
}, ['receptionist']);

$router->add('GET', 'reception/payments', function () {
    $payments = DB::conn()->query('SELECT * FROM payments ORDER BY paid_at DESC')->fetchAll();
    Response::view('reception/payments', ['title' => 'المدفوعات', 'payments' => $payments]);
}, ['receptionist']);

$router->add('GET', 'patient/dashboard', function () {
    Response::view('patient/dashboard', ['title' => 'لوحة المريض', 'stats' => ['upcoming' => 0, 'last_visit' => '-', 'notifications' => 0]]);
}, ['patient']);

$router->add('GET', 'patient/doctors', function () use ($config) {
    Response::view('patient/doctors', [
        'title' => 'الأطباء',
        'doctors' => Doctor::all(),
        'specializations' => Specialization::all(),
        'branches' => Branch::all(),
        'currency' => $config['currency']
    ]);
}, ['patient']);

$router->add('GET', 'patient/doctor_view', function () use ($config) {
    $id = (int)($_GET['id'] ?? 0);
    $doctor = Doctor::find($id);
    $schedules = $doctor ? Doctor::schedules($id) : [];
    Response::view('patient/doctor_view', [
        'title' => 'الطبيب',
        'doctor' => $doctor,
        'schedules' => $schedules,
        'currency' => $config['currency']
    ]);
}, ['patient']);

$router->add('GET', 'patient/appointment_book', function () use ($config) {
    $doctorId = (int)($_GET['doctor_id'] ?? 0);
    $doctor = Doctor::find($doctorId);
    $settingsRows = Settings::all();
    $settings = [];
    foreach ($settingsRows as $row) {
        $settings[$row['key']] = $row['value'];
    }
    Response::view('patient/appointment_book', [
        'title' => 'حجز موعد',
        'doctor' => $doctor,
        'currency' => $config['currency'],
        'settings' => $settings
    ]);
}, ['patient']);

$router->add('POST', 'patient/appointment_book', function () {
    if (!CSRF::check($_POST['csrf_token'] ?? null)) {
        Helpers::flash('error', 'رمز التحقق غير صالح');
        Helpers::redirect('index.php?route=patient/appointment_book&doctor_id=' . ($_POST['doctor_id'] ?? 0));
    }
    $user = Auth::user();
    $patientProfile = PatientProfile::findByUser($user['id']);
    $doctor = Doctor::find((int)$_POST['doctor_id']);
    if (!$patientProfile || !$doctor) {
        Helpers::flash('error', 'بيانات غير مكتملة');
        Helpers::redirect('index.php?route=patient/appointment_book&doctor_id=' . ($_POST['doctor_id'] ?? 0));
    }
    $appointmentId = AppointmentService::book([
        'patient_id' => $user['id'],
        'doctor_id' => $doctor['id'],
        'branch_id' => $doctor['branch_id'],
        'appointment_date' => $_POST['appointment_date'],
        'appointment_time' => $_POST['appointment_time'],
        'reason' => $_POST['reason'],
        'user_id' => $user['id'],
        'notify_user_ids' => [$user['id']]
    ]);
    Helpers::flash('success', 'تم إنشاء الحجز رقم ' . $appointmentId);
    Helpers::redirect('index.php?route=patient/my_appointments');
}, ['patient']);

$router->add('GET', 'patient/my_appointments', function () {
    $user = Auth::user();
    $appointments = Appointment::byPatient($user['id']);
    Response::view('patient/my_appointments', ['title' => 'مواعيدي', 'appointments' => $appointments]);
}, ['patient']);

$router->add('GET', 'patient/medical_history', function () {
    $user = Auth::user();
    $histories = MedicalHistory::byPatient($user['id']);
    Response::view('patient/medical_history', ['title' => 'السجل الطبي', 'histories' => $histories]);
}, ['patient']);

$router->add('GET', 'patient/prescriptions', function () {
    $user = Auth::user();
    $prescriptions = Prescription::byPatient($user['id']);
    Response::view('patient/prescriptions', ['title' => 'الوصفات', 'prescriptions' => $prescriptions]);
}, ['patient']);

$router->add('GET', 'patient/bills', function () {
    $user = Auth::user();
    $bills = Bill::byPatient($user['id']);
    Response::view('patient/bills', ['title' => 'الفواتير', 'bills' => $bills]);
}, ['patient']);

$router->dispatch($route, $_SERVER['REQUEST_METHOD']);
