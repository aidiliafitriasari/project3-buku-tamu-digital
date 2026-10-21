<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>


<!-- CARD: Sukses -->
<div class="guest-card guest-success-card">

    <!-- Bagian utama: informasi sukses dan status -->
    <div class="guest-success-top">

        <div class="guest-success-content">

            <div class="guest-success-heading">
                <div class="guest-success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>

                <h1 class="guest-success-title">
                    Registrasi Berhasil!
                </h1>
            </div>

            <p class="guest-success-subtitle">
                Kunjungan Anda telah berhasil dicatat dalam sistem buku tamu.
            </p>

        </div>

        <!-- Status kunjungan -->
        <div class="guest-success-status">
            <span class="guest-success-status-label">Status Kunjungan</span>

            <span class="app-badge app-badge-menunggu">
                <i class="bi bi-hourglass-split"></i>
                Menunggu
            </span>
        </div>

    </div>

    <!-- Petunjuk langkah selanjutnya -->
    <div class="guest-success-next">

        <div class="guest-success-next-icon">
            <i class="bi bi-info-circle"></i>
        </div>

        <div class="guest-success-next-content">
            <h2>Langkah Selanjutnya</h2>

            <p>
                Silakan datang ke resepsionis atau petugas untuk melakukan
                pengecekan dan verifikasi data kunjungan Anda.
            </p>
        </div>

    </div>

</div>

<!-- CARD: QR CODE -->
<div class="guest-card guest-qr-card">

    <div class="guest-card-header">
        <div class="guest-card-icon">
            <i class="bi bi-qr-code"></i>
        </div>

        <div>
            <h2 class="guest-card-title">QR Code Kunjungan</h2>
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

<!-- CARD: DETAIL KUNJUNGAN -->
<div class="guest-card guest-detail-card">

    <details class="guest-detail-collapse">

        <summary class="guest-detail-summary">

            <div class="guest-card-icon">
                <i class="bi bi-clipboard-data"></i>
            </div>

            <span class="guest-detail-summary-content">
                <span class="guest-card-title">Detail Kunjungan</span>
                <span class="guest-card-description">
                    Lihat informasi lengkap kunjungan Anda.
                </span>
            </span>

            <i class="bi bi-chevron-down guest-detail-chevron"></i>

        </summary>

        <div class="guest-detail-list">

            <div class="guest-detail-item">
                <span class="guest-detail-label">Nama Tamu</span>
                <span class="guest-detail-value">
                    <?= esc($visit['guest_name']) ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Kode Kunjungan</span>
                <span class="guest-detail-value guest-detail-code">
                    <?= esc($visit['visit_code']) ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Asal Instansi</span>
                <span class="guest-detail-value">
                    <?= esc($visit['origin_institution']) ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Departemen Tujuan</span>
                <span class="guest-detail-value">
                    <?= esc($visit['department_name'] ?? '-') ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Pegawai Tujuan</span>
                <span class="guest-detail-value">
                    <?= esc($visit['employee_name'] ?? '-') ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Keperluan</span>
                <span class="guest-detail-value">
                    <?= esc($visit['purpose_name'] ?? '-') ?>
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Jumlah Rombongan</span>
                <span class="guest-detail-value">
                    <?= esc($visit['group_count']) ?> orang
                </span>
            </div>

            <div class="guest-detail-item">
                <span class="guest-detail-label">Waktu Kedatangan</span>
                <span class="guest-detail-value">
                    <?= esc(date('d M Y, H:i', strtotime($visit['arrival_at']))) ?>
                </span>
            </div>

        </div>

    </details>

</div>

<!-- TOMBOL -->
<div class="guest-success-actions">

    <a
        href="<?= esc($qrDataUri) ?>"
        download="QR-Kunjungan-<?= esc($visit['visit_code']) ?>.png"
        class="guest-btn guest-btn-secondary guest-btn-block">

        <i class="bi bi-download"></i>
        Unduh QR Code

    </a>

    <a
        href="<?= base_url('/') ?>"
        class="guest-btn guest-btn-primary guest-btn-block">

        <i class="bi bi-house"></i>
        Kembali ke Halaman Awal

    </a>

</div>

<?= $this->endSection() ?>