<?php
helper('color');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>
        <?= $title ?? 'Panel Buku Tamu Digital' ?>
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

    <!-- Panel Layout -->
    <link rel="stylesheet" href="<?= base_url('assets/css/panel.css') ?>">

    <!-- Shared Components -->
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">

    <!-- Shared Dynamic Color -->
    <?= $this->include('partials/dynamic-color') ?>

    <?= $this->include('partials/pwa-head') ?>

    <?= $this->renderSection('styles') ?>

</head>

<body data-base-url="<?= base_url() ?>"
    data-is-admin="<?= session()->get('role') === 'administrator' ? 'true' : 'false' ?>">

    <div id="panel-app">

        <?= $this->include('partials/panel-sidebar') ?>

        <div class="panel-main">

            <?= $this->include('partials/panel-navbar') ?>

            <main class="panel-content">

                <?= $this->renderSection('content') ?>

            </main>

            <?= $this->include('partials/panel-footer') ?>

        </div>

    </div>

    <?= $this->include('partials/panel-bottom-nav') ?>

    <?= $this->include('partials/toast') ?>

    <?= $this->include('partials/toast-modal') ?>

    <?= $this->include('partials/confirm-modal') ?>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/panel.js') ?>"></script>
    <script src="<?= base_url('assets/js/confirm.js') ?>"></script>
    <script src="<?= base_url('assets/js/toast.js') ?>"></script>
    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>