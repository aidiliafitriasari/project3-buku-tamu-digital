<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasTestError = ($formId === 'test_whatsapp');
?>

<div
    class="modal fade"
    id="testWhatsappModal"
    data-test-error="<?= $hasTestError ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="testWhatsappModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-send"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="testWhatsappModalLabel">
                            Test Kirim WhatsApp
                        </h2>

                        <p class="master-modal-description">
                            Kirim pesan test untuk memverifikasi kredensial API.
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
                action="<?= base_url('admin/whatsapp-settings/test') ?>"
                method="post"
                novalidate>

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-group">

                            <label for="test_phone" class="master-form-label">
                                Nomor HP Tujuan
                                <span class="master-form-required">*</span>
                            </label>

                            <input
                                type="tel"
                                id="test_phone"
                                name="phone"
                                class="master-form-input"
                                value="<?= esc(old('phone')) ?>"
                                placeholder="628123456789"
                                maxlength="20"
                                required>

                            <p class="master-form-help">
                                <i class="bi bi-info-circle"></i>
                                Format: 628xxx atau 08xxx. Otomatis dinormalisasi.
                            </p>

                        </div>

                        <div class="master-form-group">

                            <label for="test_message" class="master-form-label">
                                Pesan Test
                                <span class="master-form-required">*</span>
                            </label>

                            <textarea
                                id="test_message"
                                name="message"
                                class="master-form-textarea"
                                rows="4"
                                maxlength="500"
                                required><?= esc(old('message', 'Test dari Buku Tamu Digital — ' . date('d M Y, H:i'))) ?></textarea>

                        </div>

                        <?php if (! empty($settings['is_enabled']) && (int) $settings['is_enabled'] === 0): ?>
                            <div class="app-alert app-alert-warning">
                                <i class="bi bi-exclamation-triangle"></i>
                                Integrasi WhatsApp saat ini <strong>nonaktif</strong> — pesan akan masuk <strong>log mode</strong> (tidak dikirim ke WA).
                            </div>
                        <?php endif; ?>

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

                        <i class="bi bi-send"></i>
                        Kirim Test

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>