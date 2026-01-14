<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">نظام الدور</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>رقم الدور</th>
                        <th>الطبيب</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($queues ?? []) as $queue): ?>
                        <tr>
                            <td><?= Helpers::e($queue['queue_number']) ?></td>
                            <td><?= Helpers::e($queue['doctor_name']) ?></td>
                            <td><?= Helpers::e($queue['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
