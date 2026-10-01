<?php
helper('color');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

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

    <?= $this->renderSection('styles') ?>

</head>

<body data-base-url="<?= base_url() ?>">

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

    <?= $this->include('partials/toast') ?>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <!-- Custom JS -->
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/panel.js') ?>"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>