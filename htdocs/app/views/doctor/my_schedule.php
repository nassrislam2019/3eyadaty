<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">جدول عملي</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr><th>اليوم</th><th>من</th><th>إلى</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($schedules ?? []) as $row): ?>
                        <tr>
                            <td><?= Helpers::e($row['day_of_week']) ?></td>
                            <td><?= Helpers::e($row['start_time']) ?></td>
                            <td><?= Helpers::e($row['end_time']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
