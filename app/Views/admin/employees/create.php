<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasCreateErrors = ($formId === 'create_employee') && ! empty($errors);
$validationErrors = $hasCreateErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="createEmployeeModal"
    data-create-error="<?= $hasCreateErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createEmployeeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-person-plus"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="createEmployeeModalLabel">
                            Tambah Pegawai
                        </h2>

                        <p class="master-modal-description">
                            Tambahkan data pegawai baru.
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
                action="<?= base_url('admin/employees') ?>"
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
                                        Informasi Pegawai
                                    </h3>

                                    <p class="master-form-section-description">
                                        Masukkan identitas pegawai.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group master-form-group-full">

                                    <label for="modal_employee_name" class="master-form-label">
                                        Nama Pegawai
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        id="modal_employee_name"
                                        name="name"
                                        class="master-form-input <?= isset($validationErrors['name']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('name')) ?>"
                                        placeholder="Masukkan nama lengkap pegawai"
                                        autocomplete="name"
                                        required>

                                    <?php if (isset($validationErrors['name'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['name']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label for="modal_employee_department_id" class="master-form-label">
                                        Bagian
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <select
                                        id="modal_employee_department_id"
                                        name="department_id"
                                        class="master-form-select <?= isset($validationErrors['department_id']) ? 'is-invalid' : '' ?>"
                                        required>

                                        <option value="">Pilih bagian</option>

                                        <?php foreach (($departments ?? []) as $department): ?>
                                            <option
                                                value="<?= esc($department['id']) ?>"
                                                <?= (string) old('department_id') === (string) $department['id'] ? 'selected' : '' ?>>
                                                <?= esc($department['name']) ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>

                                    <?php if (isset($validationErrors['department_id'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['department_id']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                                <div class="master-form-group">

                                    <label for="modal_employee_nomor_hp" class="master-form-label">
                                        Nomor HP
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="tel"
                                        id="modal_employee_nomor_hp"
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

                                    <label for="modal_employee_email" class="master-form-label">
                                        Email
                                        <span class="master-form-required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        id="modal_employee_email"
                                        name="email"
                                        class="master-form-input <?= isset($validationErrors['email']) ? 'is-invalid' : '' ?>"
                                        value="<?= esc(old('email')) ?>"
                                        placeholder="Contoh: nama@aminsproject.com"
                                        autocomplete="email"
                                        required>

                                    <?php if (isset($validationErrors['email'])): ?>
                                        <div class="master-form-error">
                                            <?= esc($validationErrors['email']) ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                        <div class="master-form-note">
                            <i class="bi bi-info-circle"></i>
                            <span>
                                Pegawai baru akan dibuat dengan status Aktif.
                                Untuk menonaktifkan, gunakan tombol toggle di daftar.
                            </span>
                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="bi bi-check-lg"></i> Simpan Pegawai
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>