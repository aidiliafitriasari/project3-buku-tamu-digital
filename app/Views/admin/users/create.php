<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasCreateUserErrors = ($formId === 'create_user') && ! empty($errors);
$validationErrors = $hasCreateUserErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="createUserModal"
    data-create-user-error="<?= $hasCreateUserErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>

                    <div>
                        <h2
                            class="master-modal-title"
                            id="createUserModalLabel">
                            Tambah Pengguna
                        </h2>

                        <p class="master-modal-description">
                            Tambahkan akun Administrator atau Petugas baru.
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
                action="<?= base_url('admin/users') ?>"
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
                                        Masukkan identitas dasar pengguna.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">

                                    <label
                                        for="modal_username"
                                        class="master-form-label">
                                        Username
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="modal_username"
                                        name="username"
                                        class="master-form-input <?= isset($validationErrors['username']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('username')) ?>"
                                        placeholder="Contoh: petugas01"
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
                                        for="modal_email"
                                        class="master-form-label">
                                        Email
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="modal_email"
                                        name="email"
                                        class="master-form-input <?= isset($validationErrors['email']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('email')) ?>"
                                        placeholder="Contoh: petugas@aminsproject.id"
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
                                        for="modal_nomor_hp"
                                        class="master-form-label">
                                        Nomor HP
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="modal_nomor_hp"
                                        name="nomor_hp"
                                        class="master-form-input <?= isset($validationErrors['nomor_hp']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('nomor_hp')) ?>"
                                        placeholder="Contoh: 081234567890"
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
                                        for="modal_role"
                                        class="master-form-label">
                                        Role
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <select
                                        id="modal_role"
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

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Keamanan Akun
                                    </h3>

                                    <p class="master-form-section-description">
                                        Password minimal 8 karakter.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">

                                    <label
                                        for="modal_password"
                                        class="master-form-label">
                                        Password
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-password-wrapper">

                                        <input
                                            type="password"
                                            id="modal_password"
                                            name="password"
                                            class="master-form-input <?= isset($validationErrors['password']) ? 'is-invalid' : '' ?>"
                                            placeholder="Minimal 8 karakter"
                                            autocomplete="new-password"
                                            required>

                                        <button
                                            type="button"
                                            class="master-password-toggle"
                                            data-password-target="modal_password"
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

                                    <?php if ($hasCreateUserErrors): ?>
                                        <p class="master-form-help">
                                            <i class="bi bi-info-circle"></i>
                                            Password harus diisi ulang setiap kali validasi gagal (alasan keamanan).
                                        </p>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label
                                        for="modal_password_confirmation"
                                        class="master-form-label">
                                        Konfirmasi Password
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <div class="master-password-wrapper">

                                        <input
                                            type="password"
                                            id="modal_password_confirmation"
                                            name="password_confirmation"
                                            class="master-form-input <?= isset($validationErrors['password_confirmation']) ? 'is-invalid' : '' ?>"
                                            placeholder="Ulangi password"
                                            autocomplete="new-password"
                                            required>

                                        <button
                                            type="button"
                                            class="master-password-toggle"
                                            data-password-target="modal_password_confirmation"
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
                                Akun baru akan dibuat dalam status aktif
                                sesuai role yang dipilih.
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
                        Simpan Pengguna
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>