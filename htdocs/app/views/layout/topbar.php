<?php
$user = Auth::user();
?>
<nav class="topbar">
    <div class="topbar-brand">3eyadaty</div>
    <div class="topbar-actions">
        <div class="topbar-user">
            <span><?= Helpers::e($user['name'] ?? 'زائر') ?></span>
            <small><?= Helpers::e($user['role'] ?? 'guest') ?></small>
        </div>
        <a class="btn btn-sm btn-outline-light" href="<?= Helpers::baseUrl('index.php?route=notifications') ?>">الإشعارات</a>
        <?php if ($user): ?>
            <a class="btn btn-sm btn-light" href="<?= Helpers::baseUrl('index.php?route=logout') ?>">خروج</a>
        <?php else: ?>
            <a class="btn btn-sm btn-light" href="<?= Helpers::baseUrl('index.php?route=login') ?>">دخول</a>
        <?php endif; ?>
    </div>
</nav>
