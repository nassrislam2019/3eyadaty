<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الإشعارات</h2>
        <ul class="list-group">
            <?php foreach (($notifications ?? []) as $note): ?>
                <li class="list-group-item">
                    <strong><?= Helpers::e($note['title']) ?></strong>
                    <div><?= Helpers::e($note['body']) ?></div>
                    <small class="text-muted"><?= Helpers::e($note['created_at']) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
