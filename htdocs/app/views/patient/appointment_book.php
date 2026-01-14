<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">حجز موعد</h2>
        <?php require __DIR__ . '/../partials/flash.php'; ?>
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= Helpers::baseUrl('index.php?route=patient/appointment_book') ?>">
                    <input type="hidden" name="csrf_token" value="<?= CSRF::token() ?>">
                    <input type="hidden" name="doctor_id" value="<?= Helpers::e($doctor['id'] ?? '') ?>">
                    <div class="mb-3">
                        <label class="form-label">اليوم</label>
                        <input type="date" name="appointment_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الوقت</label>
                        <input type="time" name="appointment_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">سبب الزيارة</label>
                        <textarea name="reason" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="alert alert-info">السعر: <?= Helpers::e($doctor['price'] ?? '') ?> <?= Helpers::e($currency ?? '') ?> | سياسة الإلغاء: قبل <?= Helpers::e($settings['cancellation_hours'] ?? '') ?> ساعات</div>
                    <button class="btn btn-success">تأكيد الحجز</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
