<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">التخصصات</h2>
        <div class="row g-3">
            <?php foreach (($specializations ?? []) as $spec): ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <?= Helpers::e($spec['name']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
