<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">إدارة الحجوزات</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>المريض</th><th>الطبيب</th><th>التاريخ</th><th>الحالة</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($appointments ?? []) as $appt): ?>
                        <tr>
                            <td><?= Helpers::e($appt['patient_name']) ?></td>
                            <td><?= Helpers::e($appt['doctor_name']) ?></td>
                            <td><?= Helpers::e($appt['appointment_date']) ?></td>
                            <td><?= Helpers::e($appt['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
