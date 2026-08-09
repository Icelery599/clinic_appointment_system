<?php require_once __DIR__ . '/bootstrap.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app.css">
</head>
<body>
<?php include __DIR__ . '/navbar.php'; ?>
<main class="container py-4">
<?php foreach (consume_flash() as $message): ?>
    <div class="alert alert-<?= e($message['type']) ?>"><?= e($message['message']) ?></div>
<?php endforeach; ?>
