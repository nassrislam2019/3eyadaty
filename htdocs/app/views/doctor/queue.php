<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">قائمة الدور</h2>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr><th>رقم الدور</th><th>الحالة</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($queues ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['queue_number']) ?></td>
                            <td><?= Helpers::e($row['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
