<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">التقارير</h2>
        <div class="card mb-4">
            <div class="card-body">
                <h5>تقرير الحجوزات حسب الحالة</h5>
                <ul class="list-group">
                    <?php foreach (($appointmentSummary ?? []) as $row): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><?= Helpers::e($row['status']) ?></span>
                            <span><?= Helpers::e($row['total']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>تقرير الإيرادات</h5>
                <p>إجمالي الفواتير: <?= Helpers::e($revenueSummary['total_amount'] ?? 0) ?> <?= Helpers::e($currency ?? '') ?></p>
                <p>إجمالي المدفوع: <?= Helpers::e($revenueSummary['total_paid'] ?? 0) ?> <?= Helpers::e($currency ?? '') ?></p>
                <p>المتبقي: <?= Helpers::e(($revenueSummary['total_amount'] ?? 0) - ($revenueSummary['total_paid'] ?? 0)) ?> <?= Helpers::e($currency ?? '') ?></p>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
