<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">المدفوعات</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>الفاتورة</th><th>المبلغ</th><th>الطريقة</th><th>التاريخ</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($payments ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['bill_id']) ?></td>
                            <td><?= Helpers::e($row['amount']) ?></td>
                            <td><?= Helpers::e($row['method']) ?></td>
                            <td><?= Helpers::e($row['paid_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
