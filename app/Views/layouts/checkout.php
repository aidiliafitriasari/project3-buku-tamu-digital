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
        <?= $title ?? 'Checkout Kunjungan' ?>
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
    <link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/checkout.css') ?>">

    <?= $this->include('partials/dynamic-color') ?>

    <?= $this->renderSection('styles') ?>

</head>

<body data-base-url="<?= base_url() ?>" class="checkout-body">

    <div id="checkout-app">

        <header class="checkout-header">

            <div class="checkout-header-inner">

                <a
                    href="<?= base_url('petugas/visits') ?>"
                    class="checkout-back"
                    aria-label="Kembali">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <div class="checkout-header-brand">

                    <?php if (institution_logo()): ?>
                        <img
                            src="<?= base_url(institution_logo()) ?>"
                            alt="Logo <?= esc(institution_name()) ?>"
                            class="checkout-header-logo">
                    <?php else: ?>
                        <div class="checkout-header-logo-placeholder">
                            <i class="bi bi-building"></i>
                        </div>
                    <?php endif; ?>

                    <div class="checkout-header-info">
                        <h1 class="checkout-header-title">
                            Checkout Kunjungan
                        </h1>
                        <p class="checkout-header-subtitle">
                            <?= esc(institution_name()) ?>
                        </p>
                    </div>

                </div>

            </div>

        </header>

        <main class="checkout-content">

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