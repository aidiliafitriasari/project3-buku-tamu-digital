<?php
helper('color');
helper('institution');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <title>
        <?= $title ?? institution_name() ?>
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

    <!-- Guest Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/guest.css') ?>">

    <!-- Shared Dynamic Color -->
    <?= $this->include('partials/dynamic-color') ?>

    <!-- PWA META TAGS -->
    <?= $this->include('partials/pwa-head') ?>

    <?= $this->renderSection('styles') ?>

</head>

<body data-base-url="<?= base_url() ?>" class="guest-body">

    <div id="guest-app">

        <?= $this->include('partials/guest-header') ?>

        <main class="guest-content">

            <?= $this->renderSection('content') ?>

        </main>

        <?= $this->include('partials/guest-footer') ?>

    </div>

    <?= $this->include('partials/toast') ?>

    <?= $this->include('partials/toast-modal') ?>

    <?= $this->include('partials/confirm-modal') ?>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/toast.js') ?>"></script>
    <script src="<?= base_url('assets/js/confirm.js') ?>"></script>
    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>