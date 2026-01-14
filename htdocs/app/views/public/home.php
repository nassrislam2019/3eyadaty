<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <?php require __DIR__ . '/../partials/flash.php'; ?>
        <section class="hero card mb-4">
            <div class="card-body">
                <h1 class="mb-3">منصة 3eyadaty لإدارة العيادات الطبية</h1>
                <p>نظام متكامل لإدارة الحجوزات، الدور، السجلات الطبية، الفواتير، والإشعارات.</p>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary" href="<?= Helpers::baseUrl('index.php?route=login') ?>">تسجيل الدخول</a>
                    <a class="btn btn-outline-primary" href="<?= Helpers::baseUrl('index.php?route=register') ?>">إنشاء حساب</a>
                </div>
            </div>
        </section>

        <section class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6>عدد الأطباء</h6>
                        <h3><?= Helpers::e($stats['doctors'] ?? 0) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6>عدد المرضى</h6>
                        <h3><?= Helpers::e($stats['patients'] ?? 0) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card">
                    <div class="card-body">
                        <h6>إجمالي الحجوزات</h6>
                        <h3><?= Helpers::e($stats['appointments'] ?? 0) ?></h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="card mb-4">
            <div class="card-body">
                <h4 class="mb-3">آخر الأطباء</h4>
                <div class="row g-3">
                    <?php foreach (($latestDoctors ?? []) as $doctor): ?>
                        <div class="col-md-4">
                            <div class="card doctor-card">
                                <div class="card-body">
                                    <h5><?= Helpers::e($doctor['name']) ?></h5>
                                    <p class="mb-1"><?= Helpers::e($doctor['specialization_name']) ?></p>
                                    <p class="mb-1"><?= Helpers::e($doctor['branch_name']) ?></p>
                                    <p class="mb-2">السعر: <?= Helpers::e($doctor['price']) ?> <?= Helpers::e($currency ?? '') ?></p>
                                    <a class="btn btn-sm btn-primary" href="<?= Helpers::baseUrl('index.php?route=public/doctor_view&id=' . $doctor['id']) ?>">عرض الملف</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-body">
                <h4 class="mb-3">التخصصات</h4>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach (($specializations ?? []) as $spec): ?>
                        <a class="btn btn-outline-secondary" href="<?= Helpers::baseUrl('index.php?route=public/doctors&specialization=' . $spec['id']) ?>">
                            <?= Helpers::e($spec['name']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
