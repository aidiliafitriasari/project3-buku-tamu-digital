<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/master/whatsapp.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                WhatsApp Settings
            </h1>

            <p class="master-description">
                Kelola integrasi WhatsApp untuk notifikasi tamu dan pegawai.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-ghost"
                data-bs-toggle="modal"
                data-bs-target="#testWhatsappModal">

                <i class="bi bi-send"></i>

                Test Kirim WA

            </button>

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#editWhatsappSettingsModal">

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
                        <i class="bi bi-whatsapp"></i>
                    </div>

                    <div>
                        <h3 class="master-form-section-title">
                            Integrasi WhatsApp
                        </h3>

                        <p class="master-form-section-description">
                            Konfigurasi API WhatsApp untuk pengiriman notifikasi.
                        </p>
                    </div>

                </div>

                <div class="master-detail-grid">

                    <div class="master-detail-item master-form-group-full">
                        <span class="master-detail-label">Status Integrasi</span>
                        <div>
                            <?php if ((int) $settings['is_enabled'] === 1): ?>
                                <span class="app-badge app-badge-active">
                                    <i class="bi bi-check-circle"></i>
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="app-badge app-badge-inactive">
                                    <i class="bi bi-x-circle"></i>
                                    Tidak Aktif
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">API URL</span>
                        <span class="master-detail-value">
                            <?= esc($settings['api_url'] ?? '-') ?>
                        </span>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">API Key</span>
                        <span class="master-detail-value">
                            <?php if (! empty($settings['api_key'])): ?>
                                <span class="master-detail-secret">
                                    ••••••••••••••
                                </span>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </span>
                    </div>

                </div>

            </div>

            <div class="master-section-divider"></div>

            <div class="master-form-section">

                <div class="master-form-section-header">

                    <div class="master-form-section-icon">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <h3 class="master-form-section-title">
                            Notifikasi Tamu
                        </h3>

                        <p class="master-form-section-description">
                            Pesan WhatsApp yang dikirim ke tamu.
                        </p>
                    </div>

                </div>

                <div class="master-detail-grid">

                    <div class="master-detail-item">
                        <span class="master-detail-label">Status</span>
                        <div>
                            <?php if ((int) $settings['guest_enabled'] === 1): ?>
                                <span class="app-badge app-badge-active">Aktif</span>
                            <?php else: ?>
                                <span class="app-badge app-badge-inactive">Tidak Aktif</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="master-detail-item master-form-group-full">
                        <span class="master-detail-label">Template Pesan</span>
                        <div class="master-detail-description">
                            <?= esc($settings['guest_template'] ?? 'Belum ada template') ?>
                        </div>
                    </div>

                </div>

            </div>

            <div class="master-section-divider"></div>

            <div class="master-form-section">

                <div class="master-form-section-header">

                    <div class="master-form-section-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <div>
                        <h3 class="master-form-section-title">
                            Notifikasi Pegawai
                        </h3>

                        <p class="master-form-section-description">
                            Pesan WhatsApp yang dikirim ke pegawai tujuan.
                        </p>
                    </div>

                </div>

                <div class="master-detail-grid">

                    <div class="master-detail-item">
                        <span class="master-detail-label">Status</span>
                        <div>
                            <?php if ((int) $settings['employee_enabled'] === 1): ?>
                                <span class="app-badge app-badge-active">Aktif</span>
                            <?php else: ?>
                                <span class="app-badge app-badge-inactive">Tidak Aktif</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="master-detail-item master-form-group-full">
                        <span class="master-detail-label">Template Pesan</span>
                        <div class="master-detail-description">
                            <?= esc($settings['employee_template'] ?? 'Belum ada template') ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('admin/whatsapp_settings/edit', ['settings' => $settings]) ?>
<?= view('admin/whatsapp_settings/test', ['settings' => $settings]) ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/whatsapp_settings.js') ?>"></script>

<?= $this->endSection() ?>