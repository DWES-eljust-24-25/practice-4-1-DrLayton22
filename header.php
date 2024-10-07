<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($title ?? 'Contact Application') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <header>
      <h1><?= htmlspecialchars($header ?? 'Contact Management System') ?></h1>
      <p class="text-muted">Author: <?= htmlspecialchars($author ?? 'Rubén Bonilla') ?></p>
    </header>