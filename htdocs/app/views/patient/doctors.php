<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">البحث عن طبيب</h2>
        <?php require __DIR__ . '/../partials/filters.php'; ?>
        <div class="row g-3">
            <?php foreach (($doctors ?? []) as $doctor): ?>
                <div class="col-md-4">
                    <div class="card doctor-card">
                        <div class="card-body">
                            <h5><?= Helpers::e($doctor['name']) ?></h5>
                            <p class="mb-1"><?= Helpers::e($doctor['specialization_name']) ?></p>
                            <p class="mb-1"><?= Helpers::e($doctor['branch_name']) ?></p>
                            <p class="mb-2">السعر: <?= Helpers::e($doctor['price']) ?> <?= Helpers::e($currency ?? '') ?></p>
                            <a class="btn btn-sm btn-primary" href="<?= Helpers::baseUrl('index.php?route=patient/doctor_view&id=' . $doctor['id']) ?>">عرض الملف</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
