<?= $this->extend('layouts/checkout') ?>

<?= $this->section('content') ?>

<div class="checkout-card">

    <div class="checkout-card-header">
        <div class="checkout-card-icon">
            <i class="bi bi-box-arrow-right"></i>
        </div>
        <div>
            <h2 class="checkout-card-title">Konfirmasi Checkout</h2>
            <p class="checkout-card-description">
                Periksa data kunjungan sebelum melakukan checkout.
            </p>
        </div>
    </div>

    <div class="checkout-detail-list">

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Kode Kunjungan</span>
            <span class="checkout-detail-value checkout-detail-code">
                <?= esc($visit['visit_code']) ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Nama Tamu</span>
            <span class="checkout-detail-value">
                <?= esc($visit['guest_name']) ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Departemen</span>
            <span class="checkout-detail-value">
                <?= esc($visit['department_name'] ?? '-') ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Pegawai</span>
            <span class="checkout-detail-value">
                <?= esc($visit['employee_name'] ?? '-') ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Keperluan</span>
            <span class="checkout-detail-value">
                <?= esc($visit['purpose_name'] ?? '-') ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Waktu Check-in</span>
            <span class="checkout-detail-value">
                <?= ! empty($visit['checkin_at']) ? esc(date('d M Y, H:i', strtotime($visit['checkin_at']))) : '-' ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Durasi</span>
            <span class="checkout-detail-value">
                <?= esc($duration['text'] ?? '-') ?>
            </span>
        </div>

        <div class="checkout-detail-item">
            <span class="checkout-detail-label">Status</span>
            <span class="checkout-detail-value">
                <span class="app-badge app-badge-berkunjung">
                    Masih Berkunjung
                </span>
            </span>
        </div>

    </div>

</div>

<div class="checkout-actions">

    <a
        href="<?= base_url('petugas/checkout') ?>"
        class="checkout-btn checkout-btn-secondary">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>

    <button
        type="button"
        class="checkout-btn checkout-btn-primary"
        id="checkoutConfirmBtn"
        data-token="<?= esc($visit['qr_token']) ?>">
        <i class="bi bi-check-circle"></i>
        Konfirmasi Checkout
    </button>

</div>

<div
    class="modal fade"
    id="checkoutSuccessModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title">
                            Checkout Berhasil
                        </h2>
                        <p class="master-modal-description">
                            Kunjungan telah selesai.
                        </p>
                    </div>

                </div>

            </div>

            <div class="master-modal-body">

                <div class="master-form">

                    <div class="master-form-section">

                        <div class="checkout-detail-list">

                            <div class="checkout-detail-item">
                                <span class="checkout-detail-label">Kode Kunjungan</span>
                                <span class="checkout-detail-value checkout-detail-code" id="success_visit_code">-</span>
                            </div>

                            <div class="checkout-detail-item">
                                <span class="checkout-detail-label">Waktu Checkout</span>
                                <span class="checkout-detail-value" id="success_checkout_at">-</span>
                            </div>

                            <div class="checkout-detail-item">
                                <span class="checkout-detail-label">Durasi</span>
                                <span class="checkout-detail-value" id="success_duration">-</span>
                            </div>

                            <div class="checkout-detail-item">
                                <span class="checkout-detail-label">Status</span>
                                <span class="checkout-detail-value">
                                    <span class="app-badge app-badge-selesai">
                                        Selesai
                                    </span>
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="master-modal-footer">

                <a
                    href="<?= base_url('petugas/checkout') ?>"
                    class="app-btn app-btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Selesai
                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/checkout.js') ?>"></script>
<?= $this->endSection() ?>