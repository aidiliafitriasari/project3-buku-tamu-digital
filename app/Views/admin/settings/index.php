<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/master/settings.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Pengaturan
            </h1>

            <p class="master-description">
                Kelola konfigurasi utama yang digunakan oleh sistem Buku Tamu Digital.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#editSettingsModal">

                <i class="bi bi-pencil-square"></i>

                Edit Pengaturan

            </button>

        </div>

    </div>

    <!-- DATA -->
    <div class="master-content">

        <div class="master-form">

            <div class="master-form-section">

                <div class="master-form-section-header">

                    <div class="master-form-section-icon">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <div>
                        <h3 class="master-form-section-title">
                            Konfigurasi Aplikasi
                        </h3>

                        <p class="master-form-section-description">
                            Pengaturan ini digunakan saat proses operasional berlangsung.
                        </p>
                    </div>

                </div>

                <div class="master-detail-grid">

                    <div class="master-detail-item">
                        <span class="master-detail-label">Warna Utama</span>

                        <div class="master-color-preview">
                            <span
                                class="master-color-swatch"
                                style="background: <?= esc($settings['primary_color']) ?>;">
                            </span>

                            <span class="master-detail-value">
                                <?= esc($settings['primary_color']) ?>
                            </span>
                        </div>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Foto Tamu</span>
                        <div>
                            <?php if ((int) $settings['photo_required'] === 1): ?>
                                <span class="app-badge app-badge-active">Wajib</span>
                            <?php else: ?>
                                <span class="app-badge app-badge-inactive">Tidak Wajib</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Tanda Tangan</span>
                        <div>
                            <?php if ((int) $settings['signature_required'] === 1): ?>
                                <span class="app-badge app-badge-active">Wajib</span>
                            <?php else: ?>
                                <span class="app-badge app-badge-inactive">Tidak Wajib</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Maksimal Ukuran Foto</span>
                        <span class="master-detail-value">
                            <?= esc($settings['max_photo_size']) ?> KB
                        </span>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Batas Peringatan Kunjungan</span>
                        <span class="master-detail-value">
                            <?= esc($settings['visit_warning']) ?> Menit
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('admin/settings/edit', ['settings' => $settings]) ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/settings.js') ?>"></script>

<?= $this->endSection() ?>