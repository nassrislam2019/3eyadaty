<form class="row g-2 mb-3" method="get">
    <input type="hidden" name="route" value="<?= Helpers::e($_GET['route'] ?? '') ?>">
    <div class="col-md-3">
        <input type="text" name="q" class="form-control" placeholder="بحث" value="<?= Helpers::e($_GET['q'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <select name="specialization" class="form-select">
            <option value="">التخصص</option>
            <?php foreach (($specializations ?? []) as $spec): ?>
                <option value="<?= Helpers::e($spec['id']) ?>" <?= (($_GET['specialization'] ?? '') == $spec['id']) ? 'selected' : '' ?>><?= Helpers::e($spec['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <select name="branch" class="form-select">
            <option value="">الفرع</option>
            <?php foreach (($branches ?? []) as $branch): ?>
                <option value="<?= Helpers::e($branch['id']) ?>" <?= (($_GET['branch'] ?? '') == $branch['id']) ? 'selected' : '' ?>><?= Helpers::e($branch['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary w-100">تطبيق</button>
    </div>
</form>
