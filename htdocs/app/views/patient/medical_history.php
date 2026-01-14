<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">السجل الطبي</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>التاريخ</th><th>التشخيص</th><th>الخطة العلاجية</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($histories ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['visit_date']) ?></td>
                            <td><?= Helpers::e($row['diagnosis']) ?></td>
                            <td><?= Helpers::e($row['treatment_plan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
