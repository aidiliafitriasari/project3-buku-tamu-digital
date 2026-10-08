<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$fromFilter = $_GET['from'] ?? 'aktif';
$menuParam  = $_GET['menu'] ?? 'aktif';

$allowedFrom = ['aktif', 'menunggu', 'masih_berkunjung', 'riwayat', 'selesai', 'ditolak', 'dibatalkan', 'terhapus'];
if (! in_array($fromFilter, $allowedFrom, true)) {
    $fromFilter = 'aktif';
}

$allowedMenu = ['aktif', 'riwayat'];
if (! in_array($menuParam, $allowedMenu, true)) {
    $menuParam = 'aktif';
}

$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$isFromSameSite = ! empty($referrer) && str_starts_with($referrer, base_url());

$backUrl = $isFromSameSite
    ? $referrer
    : base_url(($isAdmin ?? false) ? 'admin/visits' : 'petugas/visits') . '?status=' . urlencode($fromFilter) . '&menu=' . urlencode($menuParam);
?>

<div class="master-page">

    <!-- HEADER -->
    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Detail Kunjungan
            </h1>

            <p class="master-description">
                Informasi lengkap kunjungan tamu.
            </p>

        </div>

        <div class="master-header-actions">

            <?php if ($visit['status'] === 'menunggu' && empty($visit['deleted_at'])): ?>
                <button
                    type="button"
                    class="app-btn app-btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#editVisitModal"
                    data-visit-id="<?= esc($visit['id']) ?>">
                    <i class="bi bi-pencil"></i>
                    Edit Kunjungan
                </button>
            <?php endif; ?>

            <a
                href="<?= esc($backUrl) ?>"
                class="app-btn app-btn-ghost">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

        </div>

    </div>

    <!-- STATUS & KODE -->
    <div class="master-content" style="padding: 20px;">

        <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;">

            <div>
                <span class="master-detail-label">Kode Kunjungan</span>
                <div style="font-size: 20px; font-weight: 700; color: var(--app-text-primary); margin-top: 4px;">
                    <?= esc($visit['visit_code']) ?>
                </div>
            </div>

            <div>
                <?= view('petugas/visits/_status_badge', ['visit' => $visit]) ?>
            </div>

        </div>

    </div>

    <!-- INFORMASI KUNJUNGAN -->
    <div class="master-content">

        <div class="master-form-section">

            <div class="master-form-section-header">

                <div class="master-form-section-icon">
                    <i class="bi bi-journal-text"></i>
                </div>

                <div>
                    <h3 class="master-form-section-title">
                        Informasi Kunjungan
                    </h3>
                    <p class="master-form-section-description">
                        Data kunjungan yang tercatat.
                    </p>
                </div>

            </div>

            <div class="master-detail-grid">

                <div class="master-detail-item">
                    <span class="master-detail-label">Asal Instansi</span>
                    <span class="master-detail-value">
                        <?= esc($visit['origin_institution'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Departemen Tujuan</span>
                    <span class="master-detail-value">
                        <?= esc($visit['department_name'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Pegawai Tujuan</span>
                    <span class="master-detail-value">
                        <?= esc($visit['employee_name'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Keperluan</span>
                    <span class="master-detail-value">
                        <?= esc($visit['purpose_name'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Jumlah Rombongan</span>
                    <span class="master-detail-value">
                        <?= esc($visit['group_count'] ?? 1) ?> orang
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Persetujuan Data</span>
                    <span class="master-detail-value">
                        <?= ! empty($visit['data_consent']) ? 'Disetujui' : 'Tidak' ?>
                    </span>
                </div>

            </div>

        </div>

    </div>

    <!-- DATA TAMU -->
    <div class="master-content">

        <div class="master-form-section">

            <div class="master-form-section-header">

                <div class="master-form-section-icon">
                    <i class="bi bi-person-vcard"></i>
                </div>

                <div>
                    <h3 class="master-form-section-title">
                        Data Tamu
                    </h3>
                    <p class="master-form-section-description">
                        Identitas tamu yang terdaftar.
                    </p>
                </div>

            </div>

            <div class="master-detail-grid">

                <div class="master-detail-item">
                    <span class="master-detail-label">Nama Lengkap</span>
                    <span class="master-detail-value">
                        <?= esc($visit['guest_name'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Nomor HP</span>
                    <span class="master-detail-value">
                        <?= esc($visit['phone'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item master-form-group-full">
                    <span class="master-detail-label">Alamat</span>
                    <span class="master-detail-value">
                        <?= esc($visit['address'] ?? '-') ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Jenis Identitas</span>
                    <span class="master-detail-value">
                        <?= esc(strtoupper($visit['identity_type'] ?? '-')) ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Nomor Identitas</span>
                    <span class="master-detail-value">
                        <?= esc($visit['identity_number'] ?? '-') ?>
                    </span>
                </div>

            </div>

        </div>

    </div>

    <!-- FOTO & TANDA TANGAN -->
    <div class="master-content">

        <div class="master-form-section">

            <div class="master-form-section-header">

                <div class="master-form-section-icon">
                    <i class="bi bi-camera"></i>
                </div>

                <div>
                    <h3 class="master-form-section-title">
                        Foto & Tanda Tangan
                    </h3>
                    <p class="master-form-section-description">
                        Bukti visual kunjungan.
                    </p>
                </div>

            </div>

            <div class="master-detail-grid">

                <div class="master-detail-item">
                    <span class="master-detail-label">Foto Tamu</span>
                    <div>
                        <?php if (! empty($visit['photo'])): ?>
                            <img
                                src="<?= base_url($visit['photo']) ?>"
                                alt="Foto Tamu"
                                class="master-detail-logo">
                        <?php else: ?>
                            <span class="master-detail-value">Tidak ada foto</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Tanda Tangan</span>
                    <div>
                        <?php if (! empty($visit['signature'])): ?>
                            <img
                                src="<?= base_url($visit['signature']) ?>"
                                alt="Tanda Tangan"
                                class="master-detail-logo">
                        <?php else: ?>
                            <span class="master-detail-value">Tidak ada tanda tangan</span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- WAKTU -->
    <div class="master-content">

        <div class="master-form-section">

            <div class="master-form-section-header">

                <div class="master-form-section-icon">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>
                    <h3 class="master-form-section-title">
                        Waktu Kunjungan
                    </h3>
                    <p class="master-form-section-description">
                        Riwayat waktu kunjungan.
                    </p>
                </div>

            </div>

            <div class="master-detail-grid">

                <div class="master-detail-item">
                    <span class="master-detail-label">Waktu Kedatangan</span>
                    <span class="master-detail-value">
                        <?= esc(date('d M Y, H:i', strtotime($visit['arrival_at']))) ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Waktu Check-in</span>
                    <span class="master-detail-value">
                        <?= ! empty($visit['checkin_at']) ? esc(date('d M Y, H:i', strtotime($visit['checkin_at']))) : '-' ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Waktu Check-out</span>
                    <span class="master-detail-value">
                        <?= ! empty($visit['checkout_at']) ? esc(date('d M Y, H:i', strtotime($visit['checkout_at']))) : '-' ?>
                    </span>
                </div>

                <div class="master-detail-item">
                    <span class="master-detail-label">Durasi</span>
                    <span class="master-detail-value">
                        <?php if (! empty($visit['duration'])): ?>
                            <?php
                            $seconds = (int) $visit['duration'];
                            $minutes = floor($seconds / 60);
                            $hours = floor($minutes / 60);
                            ?>
                            <?php if ($hours > 0): ?>
                                <?= $hours ?> jam <?= $minutes % 60 ?> menit
                            <?php else: ?>
                                <?= $minutes ?> menit
                            <?php endif; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </span>
                </div>

            </div>

        </div>

    </div>

    <!-- RIWAYAT PROSES -->
    <div class="master-content">

        <div class="master-form-section">

            <div class="master-form-section-header">

                <div class="master-form-section-icon">
                    <i class="bi bi-list-check"></i>
                </div>

                <div>
                    <h3 class="master-form-section-title">
                        Riwayat Proses
                    </h3>
                    <p class="master-form-section-description">
                        Riwayat perubahan status kunjungan.
                    </p>
                </div>

            </div>

            <?php if (! empty($histories)): ?>

                <ul class="master-list" style="list-style: none; padding: 0; margin: 0;">

                    <?php foreach ($histories as $history): ?>

                        <li style="display: flex; align-items: flex-start; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--app-border);">

                            <div style="flex-shrink: 0; margin-top: 2px;">
                                <?= view('petugas/visits/_status_badge', ['visit' => ['status' => $history['status']]]) ?>
                            </div>

                            <div style="flex: 1;">
                                <div style="color: var(--app-text-primary); font-size: 12px; font-weight: 600;">
                                    <?= esc(date('d M Y, H:i', strtotime($history['created_at']))) ?>
                                </div>
                                <div style="color: var(--app-text-muted); font-size: 11px; margin-top: 2px;">
                                    Oleh: <?= esc($history['username'] ?? 'Sistem') ?>
                                </div>
                            </div>

                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php else: ?>

                <div class="app-empty">
                    <div class="app-empty-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h2 class="app-empty-title">Belum ada riwayat</h2>
                    <p class="app-empty-text">Riwayat proses akan muncul di sini.</p>
                </div>

            <?php endif; ?>

        </div>

    </div>

    <!-- AKSI -->
    <div class="master-header-actions" style="justify-content: flex-end; gap: 8px; margin-top: 16px;">

        <?php if (! empty($visit['deleted_at']) && ($isAdmin ?? false)): ?>

            <button
                type="button"
                class="app-btn app-btn-success"
                data-bs-toggle="modal"
                data-bs-target="#restoreVisitModal"
                data-visit-id="<?= esc($visit['id']) ?>"
                data-visit-code="<?= esc($visit['visit_code']) ?>"
                data-guest-name="<?= esc($visit['guest_name']) ?>">
                <i class="bi bi-arrow-counterclockwise"></i>
                Pulihkan Kunjungan
            </button>

        <?php elseif (empty($visit['deleted_at'])): ?>

            <?php if ($visit['status'] === 'menunggu'): ?>

                <!-- BATALKAN -->
                <button
                    type="button"
                    class="app-btn app-btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#cancelVisitModal"
                    data-visit-id="<?= esc($visit['id']) ?>"
                    data-visit-code="<?= esc($visit['visit_code']) ?>"
                    data-guest-name="<?= esc($visit['guest_name']) ?>">
                    <i class="bi bi-slash-circle"></i>
                    Batalkan Kunjungan
                </button>

                <!-- TOLAK -->
                <button
                    type="button"
                    class="app-btn app-btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#rejectVisitModal"
                    data-visit-id="<?= esc($visit['id']) ?>"
                    data-visit-code="<?= esc($visit['visit_code']) ?>"
                    data-guest-name="<?= esc($visit['guest_name']) ?>">
                    <i class="bi bi-x-circle"></i>
                    Tolak Kunjungan
                </button>

                <!-- PROSES VERIFIKASI -->
                <button
                    type="button"
                    class="app-btn app-btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#verifyVisitModal"
                    data-visit-id="<?= esc($visit['id']) ?>"
                    data-visit-code="<?= esc($visit['visit_code']) ?>"
                    data-guest-name="<?= esc($visit['guest_name']) ?>">
                    <i class="bi bi-check-circle"></i>
                    Proses Verifikasi
                </button>

            <?php elseif ($visit['status'] === 'masih_berkunjung'): ?>

                <!-- CHECKOUT -->
                <button
                    type="button"
                    class="app-btn app-btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#checkoutVisitModal"
                    data-visit-id="<?= esc($visit['id']) ?>"
                    data-visit-code="<?= esc($visit['visit_code']) ?>"
                    data-guest-name="<?= esc($visit['guest_name']) ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    Checkout Kunjungan
                </button>

            <?php endif; ?>

        <?php endif; ?>

    </div>

</div>

<!-- MODAL -->
<?= view('petugas/visits/verify') ?>
<?= view('petugas/visits/reject') ?>
<?= view('petugas/visits/cancel') ?>
<?= view('petugas/visits/checkout') ?>
<?= view('petugas/visits/edit') ?>
<?= view('petugas/visits/_delete') ?>
<?= view('petugas/visits/_restore') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/petugas-visits.js') ?>"></script>
<?= $this->endSection() ?>