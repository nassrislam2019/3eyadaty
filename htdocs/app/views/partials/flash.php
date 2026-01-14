<?php if ($msg = Helpers::flash('success')): ?>
    <div class="alert alert-success"><?= Helpers::e($msg) ?></div>
<?php endif; ?>
<?php if ($msg = Helpers::flash('error')): ?>
    <div class="alert alert-danger"><?= Helpers::e($msg) ?></div>
<?php endif; ?>
