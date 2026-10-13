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

    <!-- PWA META TAGS -->
    <?= $this->include('partials/pwa-head') ?>

    <?= $this->renderSection('styles') ?>

</head>

<body>

    <main class="auth-wrapper">

        <div class="auth-bg" aria-hidden="true">
            <i class="bi bi-book auth-icon auth-icon-1"></i>
            <i class="bi bi-pencil auth-icon auth-icon-2"></i>
            <i class="bi bi-person-vcard auth-icon auth-icon-3"></i>
            <i class="bi bi-clock auth-icon auth-icon-4"></i>
            <i class="bi bi-camera auth-icon auth-icon-5"></i>
            <i class="bi bi-check-circle auth-icon auth-icon-6"></i>
            <i class="bi bi-qr-code auth-icon auth-icon-7"></i>
            <i class="bi bi-person auth-icon auth-icon-8"></i>
        </div>

        <?= $this->renderSection('content') ?>

        <!-- Toast & Modal Container -->
        <?= $this->include('partials/toast') ?>
        <?= $this->include('partials/toast-modal') ?>
        <?= $this->include('partials/confirm-modal') ?>

    </main>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/toast.js') ?>"></script>
    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>