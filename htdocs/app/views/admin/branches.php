<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">الفروع</h2>
        <ul class="list-group">
            <?php foreach (($branches ?? []) as $branch): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= Helpers::e($branch['name']) ?></span>
                    <span><?= Helpers::e($branch['city']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
