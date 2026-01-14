<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">إعدادات النظام</h2>
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?= Helpers::baseUrl('index.php?route=admin/settings') ?>">
                    <input type="hidden" name="csrf_token" value="<?= CSRF::token() ?>">
                    <div class="mb-3">
                        <label class="form-label">اسم النظام</label>
                        <input type="text" name="app_name" class="form-control" value="<?= Helpers::e($settings['app_name'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">مدة الكشف (دقائق)</label>
                        <input type="number" name="visit_duration" class="form-control" value="<?= Helpers::e($settings['visit_duration'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ساعات الإلغاء المسموح بها</label>
                        <input type="number" name="cancellation_hours" class="form-control" value="<?= Helpers::e($settings['cancellation_hours'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">تفعيل التسجيل</label>
                        <select name="allow_registration" class="form-select">
                            <option value="1" <?= (($settings['allow_registration'] ?? '') === '1') ? 'selected' : '' ?>>مفعل</option>
                            <option value="0" <?= (($settings['allow_registration'] ?? '') === '0') ? 'selected' : '' ?>>معطل</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
