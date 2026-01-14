<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-body">
                <h3><?= Helpers::e($doctor['name'] ?? '') ?></h3>
                <p><?= Helpers::e($doctor['specialization_name'] ?? '') ?></p>
                <a class="btn btn-primary" href="<?= Helpers::baseUrl('index.php?route=patient/appointment_book&doctor_id=' . ($doctor['id'] ?? 0)) ?>">احجز الآن</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">الأوقات المتاحة</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead><tr><th>اليوم</th><th>من</th><th>إلى</th></tr></thead>
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
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
