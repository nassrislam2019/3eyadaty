<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/topbar.php'; ?>
<?php require __DIR__ . '/../layout/sidebar.php'; ?>
<main class="content">
    <div class="container-fluid">
        <h2 class="mb-3">إدارة الأطباء</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>التخصص</th>
                        <th>الفرع</th>
                        <th>السعر</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($doctors ?? []) as $doctor): ?>
                        <tr>
                            <td><?= Helpers::e($doctor['name']) ?></td>
                            <td><?= Helpers::e($doctor['specialization_name']) ?></td>
                            <td><?= Helpers::e($doctor['branch_name']) ?></td>
                            <td><?= Helpers::e($doctor['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php require __DIR__ . '/../layout/footer.php'; ?>
