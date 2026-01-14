<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">المستخدمون</h2>
        <?php require __DIR__ . '/../partials/flash.php'; ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>الدور</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($users ?? []) as $user): ?>
                        <tr>
                            <td><?= Helpers::e($user['name']) ?></td>
                            <td><?= Helpers::e($user['email']) ?></td>
                            <td><?= Helpers::e($user['role']) ?></td>
                            <td><?= Helpers::e($user['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
