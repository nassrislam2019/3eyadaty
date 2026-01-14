<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الأدوار والصلاحيات</h2>
        <div class="alert alert-info">يتم التحكم بالصلاحيات عبر جدول settings و role_permissions.</div>
        <ul class="list-group">
            <li class="list-group-item">Super Admin: وصول كامل</li>
            <li class="list-group-item">Admin: صلاحيات محددة حسب الإعدادات</li>
            <li class="list-group-item">Doctor: لوحة الطبيب ومهامه</li>
            <li class="list-group-item">Receptionist: إدارة الحجوزات والدور</li>
            <li class="list-group-item">Patient: متابعة الحجوزات والسجل</li>
        </ul>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
