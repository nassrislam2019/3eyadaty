<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-3">إنشاء حساب مريض</h3>
                        <?php require __DIR__ . '/../partials/flash.php'; ?>
                        <form method="post" action="<?= Helpers::baseUrl('index.php?route=register') ?>">
                            <input type="hidden" name="csrf_token" value="<?= CSRF::token() ?>">
                            <div class="mb-3">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">البريد الإلكتروني</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">كلمة المرور</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button class="btn btn-success w-100">تسجيل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
