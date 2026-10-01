<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasEditErrors = ($formId === 'edit_settings') && ! empty($errors);
$validationErrors = $hasEditErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="editSettingsModal"
    data-edit-error="<?= $hasEditErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editSettingsModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="editSettingsModalLabel">
                            Edit Pengaturan
                        </h2>

                        <p class="master-modal-description">
                            Perbarui konfigurasi aplikasi.
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    class="master-modal-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form
                action="<?= base_url('admin/settings/update') ?>"
                method="post"
                novalidate>

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-palette"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Tampilan
                                    </h3>

                                    <p class="master-form-section-description">
                                        Warna utama aplikasi.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-group">

                                <label for="edit_primary_color" class="master-form-label">
                                    Warna Utama
                                    <span class="master-form-required">*</span>
                                </label>

                                <div class="master-color-input">

                                    <input
                                        type="color"
                                        id="edit_primary_color"
                                        class="master-color-picker"
                                        data-original-value="<?= esc($settings['primary_color']) ?>"
                                        value="<?= esc(old('primary_color', $settings['primary_color'])) ?>">

                                    <input
                                        type="text"
                                        name="primary_color"
                                        id="edit_primary_color_text"
                                        class="master-form-input <?= isset($validationErrors['primary_color']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('primary_color', $settings['primary_color'])) ?>"
                                        data-original-value="<?= esc($settings['primary_color']) ?>"
                                        maxlength="7"
                                        placeholder="#00309F"
                                        required>

                                    <span
                                        id="edit_color_preview"
                                        class="master-color-preview-box"
                                        style="background: <?= esc(old('primary_color', $settings['primary_color'])) ?>;">
                                    </span>

                                </div>

                                <p class="master-form-help">
                                    <i class="bi bi-info-circle"></i>
                                    Format HEX, contoh: #00309F
                                </p>

                                <?php if (isset($validationErrors['primary_color'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['primary_color']) ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-clipboard-check"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Registrasi
                                    </h3>

                                    <p class="master-form-section-description">
                                        Pengaturan wajib/tidak wajib foto & tanda tangan.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">

                                    <label class="master-form-label">
                                        Foto Tamu
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-radio-group">

                                        <label class="master-radio">
                                            <input
                                                type="radio"
                                                name="photo_required"
                                                value="1"
                                                data-original-checked="<?= (int) $settings['photo_required'] === 1 ? '1' : '0' ?>"
                                                <?= old('photo_required', $settings['photo_required']) == 1 ? 'checked' : '' ?>>
                                            <span>Wajib</span>
                                        </label>

                                        <label class="master-radio">
                                            <input
                                                type="radio"
                                                name="photo_required"
                                                value="0"
                                                data-original-checked="<?= (int) $settings['photo_required'] === 0 ? '1' : '0' ?>"
                                                <?= old('photo_required', $settings['photo_required']) == 0 ? 'checked' : '' ?>>
                                            <span>Tidak Wajib</span>
                                        </label>

                                    </div>

                                </div>

                                <div class="master-form-group">

                                    <label class="master-form-label">
                                        Tanda Tangan
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-radio-group">

                                        <label class="master-radio">
                                            <input
                                                type="radio"
                                                name="signature_required"
                                                value="1"
                                                data-original-checked="<?= (int) $settings['signature_required'] === 1 ? '1' : '0' ?>"
                                                <?= old('signature_required', $settings['signature_required']) == 1 ? 'checked' : '' ?>>
                                            <span>Wajib</span>
                                        </label>

                                        <label class="master-radio">
                                            <input
                                                type="radio"
                                                name="signature_required"
                                                value="0"
                                                data-original-checked="<?= (int) $settings['signature_required'] === 0 ? '1' : '0' ?>"
                                                <?= old('signature_required', $settings['signature_required']) == 0 ? 'checked' : '' ?>>
                                            <span>Tidak Wajib</span>
                                        </label>

                                    </div>

                                </div>

                                <div class="master-form-group">

                                    <label for="edit_max_photo_size" class="master-form-label">
                                        Maksimal Ukuran Foto
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-input-group">

                                        <input
                                            type="number"
                                            id="edit_max_photo_size"
                                            name="max_photo_size"
                                            class="master-form-input <?= isset($validationErrors['max_photo_size']) ? 'is-invalid' : '' ?>"
                                            value="<?= esc(old('max_photo_size', $settings['max_photo_size'])) ?>"
                                            data-original-value="<?= esc($settings['max_photo_size']) ?>"
                                            min="1"
                                            required>

                                        <span class="master-input-suffix">KB</span>

                                    </div>

                                    <?php if (isset($validationErrors['max_photo_size'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['max_photo_size']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label for="edit_visit_warning" class="master-form-label">
                                        Batas Peringatan Kunjungan
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-input-group">

                                        <input
                                            type="number"
                                            id="edit_visit_warning"
                                            name="visit_warning"
                                            class="master-form-input <?= isset($validationErrors['visit_warning']) ? 'is-invalid' : '' ?>"
                                            value="<?= esc(old('visit_warning', $settings['visit_warning'])) ?>"
                                            data-original-value="<?= esc($settings['visit_warning']) ?>"
                                            min="1"
                                            required>

                                        <span class="master-input-suffix">Menit</span>

                                    </div>

                                    <?php if (isset($validationErrors['visit_warning'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['visit_warning']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button
                        type="button"
                        class="app-btn app-btn-ghost"
                        data-bs-dismiss="modal">

                        <i class="bi bi-x-lg"></i>
                        Batal

                    </button>

                    <button
                        type="submit"
                        class="app-btn app-btn-primary">

                        <i class="bi bi-check-lg"></i>
                        Simpan Pengaturan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>