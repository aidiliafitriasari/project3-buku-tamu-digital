<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasEditErrors = ($formId === 'edit_institution') && ! empty($errors);
$validationErrors = $hasEditErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="editInstitutionModal"
    data-edit-error="<?= $hasEditErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editInstitutionModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="editInstitutionModalLabel">
                            Edit Identitas Instansi
                        </h2>

                        <p class="master-modal-description">
                            Perbarui informasi utama instansi.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form
                action="<?= base_url('admin/institution/update') ?>"
                method="post"
                enctype="multipart/form-data"
                novalidate>

                <?= csrf_field() ?>

                <div class="master-modal-body">

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
                                        Pastikan informasi yang dimasukkan sudah benar.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <!-- NAMA -->
                                <div class="master-form-group">
                                    <label for="edit_name" class="master-form-label">
                                        Nama Instansi
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="edit_name"
                                        name="name"
                                        class="master-form-input <?= isset($validationErrors['name']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('name', $institution['name'])) ?>"
                                        data-original-value="<?= esc($institution['name']) ?>"
                                        maxlength="150"
                                        required>

                                    <?php if (isset($validationErrors['name'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['name']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- TELEPON -->
                                <div class="master-form-group">
                                    <label for="edit_phone" class="master-form-label">
                                        Nomor Telepon
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="edit_phone"
                                        name="phone"
                                        class="master-form-input <?= isset($validationErrors['phone']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('phone', $institution['phone'])) ?>"
                                        data-original-value="<?= esc($institution['phone']) ?>"
                                        maxlength="20"
                                        placeholder="Contoh: 081234567899"
                                        required>

                                    <?php if (isset($validationErrors['phone'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['phone']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- EMAIL -->
                                <div class="master-form-group">
                                    <label for="edit_email" class="master-form-label">
                                        Email
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="edit_email"
                                        name="email"
                                        class="master-form-input <?= isset($validationErrors['email']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('email', $institution['email'])) ?>"
                                        data-original-value="<?= esc($institution['email']) ?>"
                                        maxlength="255"
                                        placeholder="Contoh: info@instansi.id"
                                        required>

                                    <?php if (isset($validationErrors['email'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['email']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- ALAMAT -->
                                <div class="master-form-group">
                                    <label for="edit_address" class="master-form-label">
                                        Alamat
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <textarea
                                        id="edit_address"
                                        name="address"
                                        class="master-form-textarea <?= isset($validationErrors['address']) ? 'is-invalid' : '' ?>"
                                        data-original-value="<?= esc($institution['address']) ?>"
                                        rows="3"
                                        required><?= esc(old('address', $institution['address'])) ?></textarea>

                                    <?php if (isset($validationErrors['address'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['address']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- LOGO (FULL WIDTH) -->
                                <div class="master-form-group master-form-group-full">
                                    <label for="edit_logo" class="master-form-label">
                                        Logo Instansi
                                    </label>

                                    <div class="master-logo-preview">
                                        <img
                                            id="edit_logo_preview"
                                            src="<?= ! empty($institution['logo']) ? base_url($institution['logo']) : '' ?>"
                                            data-original-src="<?= ! empty($institution['logo']) ? base_url($institution['logo']) : '' ?>"
                                            alt="Preview Logo"
                                            class="master-detail-logo <?= empty($institution['logo']) ? 'is-hidden' : '' ?>">
                                    </div>

                                    <input
                                        type="file"
                                        name="logo"
                                        id="edit_logo"
                                        class="master-form-input <?= isset($validationErrors['logo']) ? 'is-invalid' : '' ?>"
                                        accept=".jpg,.jpeg,.png,.webp">

                                    <p class="master-form-help">
                                        <i class="bi bi-info-circle"></i>
                                        Format JPG, JPEG, PNG, atau WebP. Maksimal 2 MB.
                                        Kosongkan jika tidak ingin mengubah logo.
                                    </p>

                                    <?php if (isset($validationErrors['logo'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['logo']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>