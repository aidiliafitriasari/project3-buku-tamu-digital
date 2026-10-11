<?= $this->extend('layouts/checkout') ?>

<?= $this->section('content') ?>

<div class="checkout-card">

    <div class="checkout-card-header">
        <div class="checkout-card-icon">
            <i class="bi bi-qr-code-scan"></i>
        </div>
        <div>
            <h2 class="checkout-card-title">Scan QR Checkout</h2>
            <p class="checkout-card-description">
                Scan QR Code tamu untuk melakukan checkout kunjungan.
            </p>
        </div>
    </div>

    <div class="checkout-scan">

        <div
            class="checkout-scan-reader"
            id="checkoutScanReader"
            hidden>
        </div>

        <button
            type="button"
            class="checkout-btn checkout-btn-primary checkout-btn-block"
            id="checkoutScanStart">
            <i class="bi bi-camera-video"></i>
            Buka Kamera
        </button>

        <button
            type="button"
            class="checkout-btn checkout-btn-secondary checkout-btn-block"
            id="checkoutScanStop"
            hidden>
            <i class="bi bi-x-circle"></i>
            Tutup Kamera
        </button>

        <div class="checkout-scan-divider">
            atau
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script src="<?= base_url('assets/js/checkout.js') ?>"></script>
<?= $this->endSection() ?>