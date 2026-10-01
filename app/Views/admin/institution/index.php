<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/master/institution.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <!-- HEADER -->
    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Identitas Instansi
            </h1>

            <p class="master-description">
                Kelola informasi utama instansi yang digunakan pada aplikasi.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#editInstitutionModal">

                <i class="bi bi-pencil-square"></i>

                Edit Identitas

            </button>

        </div>

    </div>

    <!-- DATA -->
    <div class="master-content">

        <div class="master-form">

            <div class="master-form-section">

                <div class="master-form-section-header">

                    <div class="master-form-section-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <div>
                        <h3 class="master-form-section-title">
                            Informasi Instansi
                        </h3>

                        <p class="master-form-section-description">
                            Informasi ini digunakan sebagai identitas utama aplikasi.
                        </p>
                    </div>

                </div>

                <div class="master-detail-grid">

                    <div class="master-detail-item">
                        <span class="master-detail-label">Nama Instansi</span>
                        <span class="master-detail-value">
                            <?= esc($institution['name']) ?>
                        </span>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Nomor Telepon</span>
                        <span class="master-detail-value">
                            <?= esc($institution['phone']) ?>
                        </span>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Email</span>
                        <span class="master-detail-value">
                            <?= esc($institution['email']) ?>
                        </span>
                    </div>

                    <div class="master-detail-item">
                        <span class="master-detail-label">Alamat</span>
                        <span class="master-detail-value">
                            <?= esc($institution['address']) ?>
                        </span>
                    </div>

                    <div class="master-detail-item master-form-group-full">
                        <span class="master-detail-label">Logo</span>
                        <div>
                            <?php if (! empty($institution['logo'])): ?>
                                <img
                                    src="<?= base_url($institution['logo']) ?>"
                                    alt="Logo <?= esc($institution['name']) ?>"
                                    class="master-detail-logo">
                            <?php else: ?>
                                <span class="master-detail-value">
                                    Belum ada logo
                                </span>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('admin/institution/edit', ['institution' => $institution]) ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/institution.js') ?>"></script>

<?= $this->endSection() ?>