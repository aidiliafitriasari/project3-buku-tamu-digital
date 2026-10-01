<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasEditErrors = ($formId === 'edit_whatsapp_settings') && ! empty($errors);
$validationErrors = $hasEditErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="editWhatsappSettingsModal"
    data-edit-error="<?= $hasEditErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editWhatsappSettingsModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="editWhatsappSettingsModalLabel">
                            Edit WhatsApp Settings
                        </h2>

                        <p class="master-modal-description">
                            Konfigurasi integrasi WhatsApp.
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
                action="<?= base_url('admin/whatsapp-settings/update') ?>"
                method="post"
                novalidate>

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <!-- INTEGRASI -->
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
                                        Konfigurasi API WhatsApp.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-group">

                                <label class="master-form-label">
                                    Status Integrasi
                                    <span class="master-form-required">*</span>
                                </label>

                                <div class="master-radio-group">

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="is_enabled"
                                            value="1"
                                            data-original-checked="<?= (int) $settings['is_enabled'] === 1 ? '1' : '0' ?>"
                                            <?= old('is_enabled', $settings['is_enabled']) == 1 ? 'checked' : '' ?>>
                                        <span>Aktif</span>
                                    </label>

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="is_enabled"
                                            value="0"
                                            data-original-checked="<?= (int) $settings['is_enabled'] === 0 ? '1' : '0' ?>"
                                            <?= old('is_enabled', $settings['is_enabled']) == 0 ? 'checked' : '' ?>>
                                        <span>Tidak Aktif</span>
                                    </label>

                                </div>

                            </div>

                            <div class="master-form-group">

                                <label for="edit_api_url" class="master-form-label">
                                    API URL
                                </label>

                                <input
                                    type="url"
                                    id="edit_api_url"
                                    name="api_url"
                                    class="master-form-input <?= isset($validationErrors['api_url']) ? 'is-invalid' : '' ?>"
                                    value="<?= esc(old('api_url', $settings['api_url'] ?? '')) ?>"
                                    data-original-value="<?= esc($settings['api_url'] ?? '') ?>"
                                    placeholder="https://api.provider.com/send"
                                    maxlength="255">

                                <p class="master-form-help">
                                    <i class="bi bi-info-circle"></i>
                                    URL endpoint API WhatsApp (HTTPS).
                                </p>

                                <?php if (isset($validationErrors['api_url'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['api_url']) ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <div class="master-form-group">

                                <label for="edit_api_key" class="master-form-label">
                                    API Key
                                </label>

                                <div class="master-password-wrapper">

                                    <input
                                        type="password"
                                        id="edit_api_key"
                                        name="api_key"
                                        class="master-form-input <?= isset($validationErrors['api_key']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('api_key', $settings['api_key'] ?? '')) ?>"
                                        data-original-value="<?= esc($settings['api_key'] ?? '') ?>"
                                        placeholder="Masukkan API Key"
                                        maxlength="255"
                                        autocomplete="new-password">

                                    <button
                                        type="button"
                                        class="master-password-toggle"
                                        data-password-target="edit_api_key"
                                        aria-label="Tampilkan API Key"
                                        title="Tampilkan API Key">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                <p class="master-form-help">
                                    <i class="bi bi-info-circle"></i>
                                    API Key dari provider WhatsApp.
                                </p>

                                <?php if (isset($validationErrors['api_key'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['api_key']) ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- NOTIFIKASI TAMU -->
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

                            <div class="master-form-group">

                                <label class="master-form-label">
                                    Status Notifikasi
                                    <span class="master-form-required">*</span>
                                </label>

                                <div class="master-radio-group">

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="guest_enabled"
                                            value="1"
                                            data-original-checked="<?= (int) $settings['guest_enabled'] === 1 ? '1' : '0' ?>"
                                            <?= old('guest_enabled', $settings['guest_enabled']) == 1 ? 'checked' : '' ?>>
                                        <span>Aktif</span>
                                    </label>

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="guest_enabled"
                                            value="0"
                                            data-original-checked="<?= (int) $settings['guest_enabled'] === 0 ? '1' : '0' ?>"
                                            <?= old('guest_enabled', $settings['guest_enabled']) == 0 ? 'checked' : '' ?>>
                                        <span>Tidak Aktif</span>
                                    </label>

                                </div>

                            </div>

                            <div class="master-form-group">

                                <label for="edit_guest_template" class="master-form-label">
                                    Template Pesan
                                </label>

                                <textarea
                                    id="edit_guest_template"
                                    name="guest_template"
                                    class="master-form-textarea <?= isset($validationErrors['guest_template']) ? 'is-invalid' : '' ?>"
                                    data-original-value="<?= esc($settings['guest_template'] ?? '') ?>"
                                    rows="5"
                                    maxlength="1000"
                                    placeholder="Halo {nama_tamu}, kunjungan Anda ke {departemen} telah tercatat. Kode kunjungan: {kode_kunjungan}."><?= esc(old('guest_template', $settings['guest_template'] ?? '')) ?></textarea>

                                <div class="master-form-help">
                                    <i class="bi bi-info-circle"></i>
                                    <span>
                                        Placeholder:
                                        <code>{nama_tamu}</code>,
                                        <code>{kode_kunjungan}</code>,
                                        <code>{departemen}</code>,
                                        <code>{nama_pegawai}</code>,
                                        <code>{waktu}</code>
                                    </span>
                                </div>

                                <?php if (isset($validationErrors['guest_template'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['guest_template']) ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- NOTIFIKASI PEGAWAI -->
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

                            <div class="master-form-group">

                                <label class="master-form-label">
                                    Status Notifikasi
                                    <span class="master-form-required">*</span>
                                </label>

                                <div class="master-radio-group">

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="employee_enabled"
                                            value="1"
                                            data-original-checked="<?= (int) $settings['employee_enabled'] === 1 ? '1' : '0' ?>"
                                            <?= old('employee_enabled', $settings['employee_enabled']) == 1 ? 'checked' : '' ?>>
                                        <span>Aktif</span>
                                    </label>

                                    <label class="master-radio">
                                        <input
                                            type="radio"
                                            name="employee_enabled"
                                            value="0"
                                            data-original-checked="<?= (int) $settings['employee_enabled'] === 0 ? '1' : '0' ?>"
                                            <?= old('employee_enabled', $settings['employee_enabled']) == 0 ? 'checked' : '' ?>>
                                        <span>Tidak Aktif</span>
                                    </label>

                                </div>

                            </div>

                            <div class="master-form-group">

                                <label for="edit_employee_template" class="master-form-label">
                                    Template Pesan
                                </label>

                                <textarea
                                    id="edit_employee_template"
                                    name="employee_template"
                                    class="master-form-textarea <?= isset($validationErrors['employee_template']) ? 'is-invalid' : '' ?>"
                                    data-original-value="<?= esc($settings['employee_template'] ?? '') ?>"
                                    rows="5"
                                    maxlength="1000"
                                    placeholder="Halo {nama_pegawai}, ada tamu {nama_tamu} dari {departemen} yang ingin bertemu."><?= esc(old('employee_template', $settings['employee_template'] ?? '')) ?></textarea>

                                <div class="master-form-help">
                                    <i class="bi bi-info-circle"></i>
                                    <span>
                                        Placeholder:
                                        <code>{nama_pegawai}</code>,
                                        <code>{nama_tamu}</code>,
                                        <code>{departemen}</code>,
                                        <code>{waktu}</code>,
                                        <code>{keperluan}</code>
                                    </span>
                                </div>

                                <?php if (isset($validationErrors['employee_template'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['employee_template']) ?>
                                    </div>
                                <?php endif; ?>

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