<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">لوحة الاستقبال</h2>
        <div class="row g-3">
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>حجوزات اليوم</h6><h3><?= Helpers::e($stats['today'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>الانتظار</h6><h3><?= Helpers::e($stats['waiting'] ?? 0) ?></h3></div></div></div>
            <div class="col-md-4"><div class="card stat-card"><div class="card-body"><h6>تمت الخدمة</h6><h3><?= Helpers::e($stats['completed'] ?? 0) ?></h3></div></div></div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
