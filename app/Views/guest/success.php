<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>

<!-- CARD: Sukses -->
<div class="guest-card guest-success-card">

    <div class="guest-success-icon">
        <i class="bi bi-check-circle-fill"></i>
    </div>

    <h1 class="guest-success-title">
        Registrasi Berhasil!
    </h1>

    <p class="guest-success-subtitle">
        Kunjungan Anda telah tercatat. Silakan simpan kode & QR berikut.
    </p>

    <div class="guest-success-badge">
        <span class="app-badge app-badge-menunggu">
            <i class="bi bi-hourglass-split"></i>
            Menunggu
        </span>
    </div>

</div>

<!-- CARD: Data Kunjungan -->
<div class="guest-card">

    <div class="guest-card-header">
        <div class="guest-card-icon">
            <i class="bi bi-clipboard-data"></i>
        </div>
        <div>
            <h2 class="guest-card-title">Data Kunjungan</h2>
            <p class="guest-card-description">
                Berikut detail kunjungan Anda.
            </p>
        </div>
    </div>

    <div class="guest-detail-list">

        <div class="guest-detail-item">
            <span class="guest-detail-label">Nama Tamu</span>
            <span class="guest-detail-value"><?= esc($visit['guest_name']) ?></span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Kode Kunjungan</span>
            <span class="guest-detail-value guest-detail-code">
                <?= esc($visit['visit_code']) ?>
            </span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Asal Instansi</span>
            <span class="guest-detail-value"><?= esc($visit['origin_institution']) ?></span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Departemen Tujuan</span>
            <span class="guest-detail-value"><?= esc($visit['department_name'] ?? '-') ?></span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Pegawai Tujuan</span>
            <span class="guest-detail-value"><?= esc($visit['employee_name'] ?? '-') ?></span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Keperluan</span>
            <span class="guest-detail-value"><?= esc($visit['purpose_name'] ?? '-') ?></span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Jumlah Rombongan</span>
            <span class="guest-detail-value"><?= esc($visit['group_count']) ?> orang</span>
        </div>

        <div class="guest-detail-item">
            <span class="guest-detail-label">Waktu Kedatangan</span>
            <span class="guest-detail-value">
                <?= esc(date('d M Y, H:i', strtotime($visit['arrival_at']))) ?>
            </span>
        </div>

    </div>

</div>

<!-- CARD: QR Code -->
<div class="guest-card guest-qr-card">

    <div class="guest-card-header">
        <div class="guest-card-icon">
            <i class="bi bi-qr-code"></i>
        </div>
        <div>
            <h2 class="guest-card-title">Kode & QR Code</h2>
            <p class="guest-card-description">
                Tunjukkan QR ini kepada petugas saat checkout.
            </p>
        </div>
    </div>

    <div class="guest-qr-wrapper">

        <img
            src="<?= esc($qrDataUri) ?>"
            alt="QR Code Kunjungan"
            class="guest-qr-image">

        <div class="guest-qr-code-text">
            <?= esc($visit['visit_code']) ?>
        </div>

    </div>

    <div class="guest-qr-notes">

        <div class="guest-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>QR Code digunakan untuk proses checkout.</span>
        </div>

        <div class="guest-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>QR Code tidak digunakan untuk check-in.</span>
        </div>

        <div class="guest-qr-note">
            <i class="bi bi-info-circle"></i>
            <span>Simpan kode/QR sampai kunjungan selesai.</span>
        </div>

    </div>

</div>

<!-- TOMBOL -->
<div class="guest-success-actions">

    <button
        type="button"
        class="guest-btn guest-btn-secondary guest-btn-block"
        onclick="window.print()">

        <i class="bi bi-printer"></i>
        Cetak Halaman

    </button>

    <a
        href="<?= base_url('/') ?>"
        class="guest-btn guest-btn-primary guest-btn-block">

        <i class="bi bi-house"></i>
        Kembali ke Halaman Awal

    </a>

</div>

<?= $this->endSection() ?>