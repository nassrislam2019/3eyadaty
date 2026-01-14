<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الفواتير</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>رقم الفاتورة</th><th>القيمة</th><th>المدفوع</th><th>الحالة</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($bills ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['id']) ?></td>
                            <td><?= Helpers::e($row['amount']) ?></td>
                            <td><?= Helpers::e($row['paid_amount']) ?></td>
                            <td><?= Helpers::e($row['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
