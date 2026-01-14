<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <h3><?= Helpers::e($doctor['name'] ?? '') ?></h3>
                <p class="mb-1"><?= Helpers::e($doctor['specialization_name'] ?? '') ?></p>
                <p class="mb-1"><?= Helpers::e($doctor['branch_name'] ?? '') ?></p>
                <p class="mb-1">السعر: <?= Helpers::e($doctor['price'] ?? '') ?> <?= Helpers::e($currency ?? '') ?></p>
                <p>الخبرة: <?= Helpers::e($doctor['experience_years'] ?? '') ?> سنوات</p>
                <?php if (Auth::check()): ?>
                    <a class="btn btn-primary" href="<?= Helpers::baseUrl('index.php?route=patient/appointment_book&doctor_id=' . ($doctor['id'] ?? 0)) ?>">احجز الآن</a>
                <?php else: ?>
                    <div class="alert alert-info">يرجى تسجيل الدخول للحجز.</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">جدول المواعيد</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>اليوم</th>
                                <th>من</th>
                                <th>إلى</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (($schedules ?? []) as $schedule): ?>
                                <tr>
                                    <td><?= Helpers::e($schedule['day_of_week']) ?></td>
                                    <td><?= Helpers::e($schedule['start_time']) ?></td>
                                    <td><?= Helpers::e($schedule['end_time']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
