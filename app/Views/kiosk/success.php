<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('content') ?>

<div class="kiosk-card kiosk-success-card">
    <div class="kiosk-success-top">
        <div class="kiosk-success-content">
            <h2 class="kiosk-success-title">
                Registrasi Berhasil!
            </h2>
            <p class="kiosk-success-subtitle">
                Kunjungan Anda telah berhasil dicatat dalam sistem buku tamu.
            </p>
        </div>

        <div class="kiosk-success-status">
            <span class="kiosk-success-status-label">Status Kunjungan</span>
            <span class="app-badge app-badge-menunggu">
                <i class="bi bi-hourglass-split"></i> Menunggu
            </span>
        </div>
    </div>

    <div class="kiosk-success-next">
        <div class="kiosk-success-next-icon">
            <i class="bi bi-info-circle"></i>
        </div>
        <div class="kiosk-success-next-content">
            <h2>Langkah Selanjutnya</h2>
            <p>
                Silakan datang ke resepsionis atau petugas untuk melakukan pengecekan dan verifikasi data kunjungan Anda.
            </p>
        </div>
    </div>
</div>

<div class="kiosk-card kiosk-detail-card">

    <details class="kiosk-detail-collapse">

        <summary class="kiosk-detail-summary">

            <div class="kiosk-card-icon">
                <i class="bi bi-clipboard-data"></i>
            </div>

            <span class="kiosk-detail-summary-content">
                <span class="kiosk-card-title">Detail Kunjungan</span>
                <span class="kiosk-card-description">Lihat informasi lengkap kunjungan Anda.</span>
            </span>

            <i class="bi bi-chevron-down kiosk-detail-chevron"></i>

        </summary>
        <div class="kiosk-detail-list">

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Nama Tamu</span>
                <span class="kiosk-detail-value"><?= esc($visit['guest_name']) ?></span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Kode Kunjungan</span>
                <span class="kiosk-detail-value kiosk-detail-code">
                    <?= esc($visit['visit_code']) ?>
                </span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Asal Instansi</span>
                <span class="kiosk-detail-value"><?= esc($visit['origin_institution']) ?></span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Departemen Tujuan</span>
                <span class="kiosk-detail-value"><?= esc($visit['department_name'] ?? '-') ?></span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Pegawai Tujuan</span>
                <span class="kiosk-detail-value"><?= esc($visit['employee_name'] ?? '-') ?></span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Keperluan</span>
                <span class="kiosk-detail-value"><?= esc($visit['purpose_name'] ?? '-') ?></span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Jumlah Rombongan</span>
                <span class="kiosk-detail-value"><?= esc($visit['group_count']) ?> orang</span>
            </div>

            <div class="kiosk-detail-item">
                <span class="kiosk-detail-label">Waktu Kedatangan</span>
                <span class="kiosk-detail-value">
                    <?= esc(date('d M Y, H:i', strtotime($visit['arrival_at']))) ?>
                </span>
            </div>

        </div>

    </details>

</div>

<div class="kiosk-card kiosk-qr-card">

    <div class="kiosk-card-header">

        <div class="kiosk-card-icon">
            <i class="bi bi-qr-code"></i>
        </div>

        <div>
            <h2 class="kiosk-card-title">
                Kode & QR Code
            </h2>

            <p class="kiosk-card-description">
                Tunjukkan QR ini kepada petugas saat checkout.
            </p>
        </div>

    </div>

    <div class="kiosk-qr-wrapper">

        <img
            src="<?= esc($qrDataUri) ?>"
            alt="QR Code Kunjungan"
            class="kiosk-qr-image">

        <div class="kiosk-qr-code-text">
            <?= esc($visit['visit_code']) ?>
        </div>

    </div>

    <div class="kiosk-qr-notes">

        <div class="kiosk-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>QR Code digunakan untuk proses checkout.</span>
        </div>

        <div class="kiosk-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>QR Code tidak digunakan untuk check-in.</span>
        </div>

        <div class="kiosk-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>Simpan kode/QR sampai kunjungan selesai.</span>
        </div>

    </div>

</div>

<div class="kiosk-actions">

    <button
        type="button"
        class="kiosk-btn kiosk-btn-primary kiosk-btn-block"
        id="kioskResetBtn">
        <i class="bi bi-check-circle"></i>
        Selesai
    </button>

</div>

<div class="kiosk-reset-notice">
    <i class="bi bi-arrow-counterclockwise"></i>
    <span>
        Halaman akan otomatis reset dalam
        <span class="kiosk-countdown" id="kioskCountdown">30</span>
        detik
    </span>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/kiosk.js') ?>"></script>
<?= $this->endSection() ?>