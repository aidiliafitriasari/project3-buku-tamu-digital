<?php
$errors = session()->getFlashdata('errors') ?? [];
$formId = session()->getFlashdata('form_id');

$hasCreateErrors = ($formId === 'create_department') && ! empty($errors);
$validationErrors = $hasCreateErrors ? $errors : [];
?>

<div
    class="modal fade"
    id="createDepartmentModal"
    data-create-error="<?= $hasCreateErrors ? '1' : '0' ?>"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="createDepartmentModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-building"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="createDepartmentModalLabel">
                            Tambah Bagian
                        </h2>

                        <p class="master-modal-description">
                            Tambahkan bagian atau departemen baru.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form action="<?= base_url('admin/departments') ?>" method="post" novalidate>

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
                                        Informasi Bagian
                                    </h3>

                                    <p class="master-form-section-description">
                                        Masukkan nama bagian.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-group">

                                <label for="modal_department_name" class="master-form-label">
                                    Nama Bagian
                                    <span class="master-form-required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="modal_department_name"
                                    name="name"
                                    class="master-form-input <?= isset($validationErrors['name']) ? 'is-invalid' : '' ?>"
                                    value="<?= esc(old('name')) ?>"
                                    placeholder="Contoh: Administrasi"
                                    autocomplete="off"
                                    required>

                                <?php if (isset($validationErrors['name'])): ?>
                                    <div class="master-form-error">
                                        <?= esc($validationErrors['name']) ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="master-form-note">
                            <i class="bi bi-info-circle"></i>
                            <span>
                                Bagian baru akan dibuat dengan status Aktif.
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
                        <i class="bi bi-check-lg"></i> Simpan Bagian
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>