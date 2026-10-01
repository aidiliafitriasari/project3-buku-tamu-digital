<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');
$resetUserId = session()->getFlashdata('target_user_id');
$resetUsername = session()->getFlashdata('target_user_username');
$resetEmail = session()->getFlashdata('target_user_email');

$hasResetErrors = ($formId === 'reset_password') && ! empty($errors);
$validationErrors = $hasResetErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="resetPasswordModal"
    data-reset-error="<?= $hasResetErrors ? '1' : '0' ?>"
    data-reset-user-id="<?= esc($resetUserId ?? '') ?>"
    data-reset-username="<?= esc($resetUsername ?? '') ?>"
    data-reset-email="<?= esc($resetEmail ?? '') ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="resetPasswordModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-key"></i>
                    </div>

                    <div>
                        <h2
                            class="master-modal-title"
                            id="resetPasswordModalLabel">
                            Reset Password
                        </h2>

                        <p class="master-modal-description">
                            Atur password baru untuk akun pengguna.
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
                id="resetPasswordForm"
                method="post"
                action=""
                autocomplete="off"
                novalidate>

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Informasi Akun
                                    </h3>

                                    <p class="master-form-section-description">
                                        Password akan diatur ulang untuk akun berikut.
                                    </p>
                                </div>

                            </div>

                            <div class="master-detail-grid">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Username
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="reset_username">
                                        -
                                    </span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Email
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="reset_email">
                                        -
                                    </span>
                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Password Baru
                                    </h3>

                                    <p class="master-form-section-description">
                                        Minimal 8 karakter.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">

                                    <label
                                        for="reset_password"
                                        class="master-form-label">
                                        Password Baru
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-password-wrapper">

                                        <input
                                            type="password"
                                            id="reset_password"
                                            name="password"
                                            class="master-form-input <?= isset($validationErrors['password']) ? 'is-invalid' : '' ?>"
                                            placeholder="Minimal 8 karakter"
                                            minlength="8"
                                            autocomplete="new-password"
                                            data-lpignore="true"
                                            data-form-type="other"
                                            required>

                                        <button
                                            type="button"
                                            class="master-password-toggle"
                                            data-password-target="reset_password"
                                            aria-label="Tampilkan password"
                                            title="Tampilkan password">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                    </div>

                                    <?php if (isset($validationErrors['password'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['password']) ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($hasResetErrors): ?>
                                        <p class="master-form-help">
                                            <i class="bi bi-info-circle"></i>
                                            Password harus diisi ulang setiap kali validasi gagal (alasan keamanan).
                                        </p>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label
                                        for="reset_password_confirmation"
                                        class="master-form-label">
                                        Konfirmasi Password
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-password-wrapper">

                                        <input
                                            type="password"
                                            id="reset_password_confirmation"
                                            name="password_confirmation"
                                            class="master-form-input <?= isset($validationErrors['password_confirmation']) ? 'is-invalid' : '' ?>"
                                            placeholder="Ulangi password"
                                            minlength="8"
                                            autocomplete="new-password"
                                            data-lpignore="true"
                                            data-form-type="other"
                                            required>

                                        <button
                                            type="button"
                                            class="master-password-toggle"
                                            data-password-target="reset_password_confirmation"
                                            aria-label="Tampilkan password"
                                            title="Tampilkan password">
                                            <i class="bi bi-eye"></i>
                                        </button>

                                    </div>

                                    <?php if (isset($validationErrors['password_confirmation'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['password_confirmation']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                        <div class="master-form-note">
                            <i class="bi bi-info-circle"></i>

                            <span>
                                Password minimal 8 karakter dan konfirmasi harus sama.
                            </span>
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
                        Simpan Password
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>