<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">لوحة المريض</h2>
        <div class="row g-3">
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>الحجوزات القادمة</h6><h3><?= Helpers::e($stats['upcoming'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>آخر زيارة</h6><h3><?= Helpers::e($stats['last_visit'] ?? '-') ?></h3></div></div></div>
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>الإشعارات</h6><h3><?= Helpers::e($stats['notifications'] ?? 0) ?></h3></div></div></div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
