<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">لوحة تحكم الإدارة</h2>
        <div class="row g-3">
            <div class="col-md-3"><div class="card stat-card"><div class="card-body"><h6>الحجوزات</h6><h3><?= Helpers::e($stats['appointments'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-3"><div class="card stat-card"><div class="card-body"><h6>المرضى</h6><h3><?= Helpers::e($stats['patients'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-3"><div class="card stat-card"><div class="card-body"><h6>الأطباء</h6><h3><?= Helpers::e($stats['doctors'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-3"><div class="card stat-card"><div class="card-body"><h6>الإيرادات</h6><h3><?= Helpers::e($stats['revenue'] ?? 0) ?> <?= Helpers::e($currency ?? '') ?></h3></div></div></div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
