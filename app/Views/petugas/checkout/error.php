<?= $this->extend('layouts/checkout') ?>

<?= $this->section('content') ?>

<div class="checkout-card">

    <div class="checkout-error">

        <div class="checkout-error-icon">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

        <h2 class="checkout-error-title">
            <?= esc($title ?? 'QR Tidak Valid') ?>
        </h2>

        <p class="checkout-error-message">
            <?= esc($message ?? 'QR tidak dapat digunakan.') ?>
        </p>

    </div>

</div>

<div class="checkout-actions">

    <a
        href="<?= base_url('petugas/checkout') ?>"
        class="checkout-btn checkout-btn-primary">
        <i class="bi bi-qr-code-scan"></i>
        Scan QR Lagi
    </a>

    <a
        href="<?= base_url('petugas/visits') ?>"
        class="checkout-btn checkout-btn-secondary">
        <i class="bi bi-list-ul"></i>
        Daftar Kunjungan
    </a>

</div>

<?= $this->endSection() ?>