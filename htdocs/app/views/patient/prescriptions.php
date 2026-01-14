<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الوصفات الطبية</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>الدواء</th><th>الجرعة</th><th>التاريخ</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($prescriptions ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['medicine']) ?></td>
                            <td><?= Helpers::e($row['dosage']) ?></td>
                            <td><?= Helpers::e($row['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="alert alert-info">يمكنك طباعة الوصفة من المتصفح.</div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
