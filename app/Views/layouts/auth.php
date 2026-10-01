<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= $title ?? 'Buku Tamu Digital' ?>
    </title>

    <!-- Poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Design Tokens -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tokens.css') ?>">

    <!-- Global Foundation -->
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

    <!-- Shared Components -->
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">

    <!-- Shared Dynamic Color -->
    <?= $this->include('partials/dynamic-color') ?>

    <!-- Auth CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

    <?= $this->renderSection('styles') ?>

</head>

<body>

    <main class="auth-wrapper">

        <?= $this->renderSection('content') ?>

    </main>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>