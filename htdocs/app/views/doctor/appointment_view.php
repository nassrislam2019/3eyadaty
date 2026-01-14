<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">تفاصيل الموعد</h2>
        <div class="card">
            <div class="card-body">
                <p>المريض: <?= Helpers::e($appointment['patient_name'] ?? '') ?></p>
                <p>السبب: <?= Helpers::e($appointment['reason'] ?? '') ?></p>
                <div class="d-flex gap-2">
                    <button class="btn btn-success">بدء الكشف</button>
                    <button class="btn btn-primary">إنهاء الكشف</button>
                    <button class="btn btn-warning">تحويل للاستقبال</button>
                    <button class="btn btn-danger">إلغاء</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
