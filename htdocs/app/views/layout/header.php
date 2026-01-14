<?php
$config = require __DIR__ . '/../../../config/app.php';
$user = Auth::user();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Helpers::e($config['name']) ?> | <?= Helpers::e($title ?? '') ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="<?= Helpers::baseUrl('app/assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= Helpers::baseUrl('app/assets/css/dashboard.css') ?>">
</head>
<body>
<div class="app-container">
