<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">المرضى</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>الاسم</th><th>الهاتف</th><th>البريد</th></tr>
                </thead>
                <tbody>
                    <?php foreach (($patients ?? []) as $patient): ?>
                        <tr>
                            <td><?= Helpers::e($patient['name']) ?></td>
                            <td><?= Helpers::e($patient['phone']) ?></td>
                            <td><?= Helpers::e($patient['email']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
