<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');
$editUserId = session()->getFlashdata('edit_user_id');

$hasEditUserErrors = ($formId === 'edit_user') && ! empty($errors);
$validationErrors = $hasEditUserErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="editUserModal"
    data-edit-user-error="<?= $hasEditUserErrors ? '1' : '0' ?>"
    data-edit-user-id="<?= esc($editUserId ?? '') ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-pencil-square"></i>
                    </div>

                    <div>

                        <h2
                            class="master-modal-title"
                            id="editUserModalLabel">
                            Edit Pengguna
                        </h2>

                        <p class="master-modal-description">
                            Perbarui informasi akun pengguna.
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
                id="editUserForm"
                action=""
                method="post"
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
                                        Perbarui identitas dasar pengguna.
                                    </p>

                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">

                                    <label
                                        for="edit_username"
                                        class="master-form-label">
                                        Username
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="edit_username"
                                        name="username"
                                        class="master-form-input <?= isset($validationErrors['username']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('username')) ?>"
                                        placeholder="Username"
                                        autocomplete="username"
                                        required>

                                    <?php if (isset($validationErrors['username'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['username']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label
                                        for="edit_email"
                                        class="master-form-label">
                                        Email
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="edit_email"
                                        name="email"
                                        class="master-form-input <?= isset($validationErrors['email']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('email')) ?>"
                                        placeholder="Email"
                                        autocomplete="email"
                                        required>

                                    <?php if (isset($validationErrors['email'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['email']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label
                                        for="edit_nomor_hp"
                                        class="master-form-label">
                                        Nomor HP
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="edit_nomor_hp"
                                        name="nomor_hp"
                                        class="master-form-input <?= isset($validationErrors['nomor_hp']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('nomor_hp')) ?>"
                                        placeholder="Nomor HP"
                                        autocomplete="tel"
                                        required>

                                    <?php if (isset($validationErrors['nomor_hp'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['nomor_hp']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label
                                        for="edit_role"
                                        class="master-form-label">
                                        Role
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <select
                                        id="edit_role"
                                        name="role"
                                        class="master-form-select <?= isset($validationErrors['role']) ? 'is-invalid' : '' ?>"
                                        required>

                                        <option value="">
                                            Pilih Role
                                        </option>

                                        <option
                                            value="administrator"
                                            <?= old('role') === 'administrator' ? 'selected' : '' ?>>
                                            Administrator
                                        </option>

                                        <option
                                            value="petugas"
                                            <?= old('role') === 'petugas' ? 'selected' : '' ?>>
                                            Petugas
                                        </option>

                                    </select>

                                    <?php if (isset($validationErrors['role'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['role']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <div class="master-form-note">

                            <i class="bi bi-shield-lock"></i>

                            <span>
                                Password tidak diubah melalui form ini.
                                Gunakan fitur reset password untuk mengganti password.
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
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>