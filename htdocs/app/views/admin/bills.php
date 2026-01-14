<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الفواتير</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>المريض</th>
                        <th>القيمة</th>
                        <th>المدفوع</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($bills ?? []) as $bill): ?>
                        <tr>
                            <td><?= Helpers::e($bill['patient_name']) ?></td>
                            <td><?= Helpers::e($bill['amount']) ?></td>
                            <td><?= Helpers::e($bill['paid_amount']) ?></td>
                            <td><?= Helpers::e($bill['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
