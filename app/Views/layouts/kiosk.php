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

    <meta name="csrf-token" content="<?= csrf_hash() ?>">

    <title>
        <?= $title ?? 'Buku Tamu Digital — Kiosk' ?>
    </title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('assets/css/tokens.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/guest.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/guest/media.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/guest/consent.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kiosk.css') ?>">

    <?= $this->include('partials/dynamic-color') ?>

    <?= $this->renderSection('styles') ?>

</head>

<body data-base-url="<?= base_url() ?>" class="kiosk-body">

    <div id="kiosk-app">

        <header class="kiosk-header">

            <div class="kiosk-header-inner">

                <div class="kiosk-header-brand">

                    <?php if (institution_logo()): ?>
                        <img
                            src="<?= base_url(institution_logo()) ?>"
                            alt="Logo <?= esc(institution_name()) ?>"
                            class="kiosk-header-logo">
                    <?php else: ?>
                        <div class="kiosk-header-logo-placeholder">
                            <i class="bi bi-building"></i>
                        </div>
                    <?php endif; ?>

                    <div class="kiosk-header-info">
                        <h1 class="kiosk-header-title">
                            <?= esc(institution_name()) ?>
                        </h1>

                        <?php if (institution_address()): ?>
                            <p class="kiosk-header-subtitle">
                                <?= esc(institution_address()) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

        </header>

        <main class="kiosk-content">

            <?= $this->renderSection('content') ?>

        </main>

    </div>

    <?= $this->include('partials/toast') ?>

    <?= $this->include('partials/toast-modal') ?>

    <?= $this->include('partials/confirm-modal') ?>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/toast.js') ?>"></script>
    <script src="<?= base_url('assets/js/confirm.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>