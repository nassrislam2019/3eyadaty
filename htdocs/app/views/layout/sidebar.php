<?php
$role = Auth::user()['role'] ?? 'guest';
?>
<aside class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=home') ?>">الصفحة الرئيسية</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=public/doctors') ?>">الأطباء</a></li>
        <?php if (in_array($role, ['super_admin', 'admin'], true)): ?>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=admin/dashboard') ?>">لوحة التحكم</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=admin/users') ?>">المستخدمون</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=admin/doctors') ?>">الأطباء</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=admin/appointments') ?>">الحجوزات</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=admin/reports') ?>">التقارير</a></li>
        <?php elseif ($role === 'doctor'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=doctor/dashboard') ?>">لوحة الطبيب</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=doctor/my_appointments') ?>">مواعيدي</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=doctor/queue') ?>">الدور</a></li>
        <?php elseif ($role === 'receptionist'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=reception/dashboard') ?>">لوحة الاستقبال</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=reception/appointments') ?>">الحجوزات</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=reception/queue') ?>">الدور</a></li>
        <?php elseif ($role === 'patient'): ?>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=patient/dashboard') ?>">لوحة المريض</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=patient/my_appointments') ?>">مواعيدي</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= Helpers::baseUrl('index.php?route=patient/medical_history') ?>">سجلي الطبي</a></li>
        <?php endif; ?>
    </ul>
</aside>
