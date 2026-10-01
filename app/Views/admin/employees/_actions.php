<?php
$containerClass = $containerClass ?? 'master-table-actions';
$isDeleted = ! empty($employee['deleted_at']);
$isActive = (int) $employee['is_active'] === 1;
?>

<div class="<?= esc($containerClass) ?>">

    <?php if ($isDeleted): ?>

        <!-- RESTORE -->
        <button
            type="button"
            class="app-icon-button"
            title="Pulihkan"
            aria-label="Pulihkan pegawai"
            data-bs-toggle="modal"
            data-bs-target="#restoreEmployeeModal"
            data-employee-id="<?= esc($employee['id']) ?>"
            data-employee-name="<?= esc($employee['name']) ?>">

            <i class="bi bi-arrow-counterclockwise"></i>

        </button>

    <?php else: ?>

        <!-- EDIT -->
        <button
            type="button"
            class="app-icon-button"
            title="Edit"
            aria-label="Edit pegawai"
            data-bs-toggle="modal"
            data-bs-target="#editEmployeeModal"
            data-employee-id="<?= esc($employee['id']) ?>"
            data-name="<?= esc($employee['name']) ?>"
            data-department-id="<?= esc($employee['department_id']) ?>"
            data-nomor-hp="<?= esc($employee['nomor_hp']) ?>"
            data-email="<?= esc($employee['email']) ?>">

            <i class="bi bi-pencil"></i>

        </button>

        <!-- TOGGLE STATUS -->
        <?php if ($isActive): ?>

            <button
                type="button"
                class="app-icon-button"
                title="Nonaktifkan"
                aria-label="Nonaktifkan pegawai"
                data-bs-toggle="modal"
                data-bs-target="#toggleEmployeeModal"
                data-employee-id="<?= esc($employee['id']) ?>"
                data-employee-name="<?= esc($employee['name']) ?>"
                data-is-active="1"
                data-status-label="Aktif">

                <i class="bi bi-toggle-on"></i>

            </button>

        <?php else: ?>

            <button
                type="button"
                class="app-icon-button"
                title="Aktifkan"
                aria-label="Aktifkan pegawai"
                data-bs-toggle="modal"
                data-bs-target="#toggleEmployeeModal"
                data-employee-id="<?= esc($employee['id']) ?>"
                data-employee-name="<?= esc($employee['name']) ?>"
                data-is-active="0"
                data-status-label="Tidak Aktif">

                <i class="bi bi-toggle-off"></i>

            </button>

        <?php endif; ?>

        <!-- HAPUS -->
        <button
            type="button"
            class="app-icon-button app-icon-button-danger"
            title="Hapus"
            aria-label="Hapus pegawai"
            data-bs-toggle="modal"
            data-bs-target="#deleteEmployeeModal"
            data-employee-id="<?= esc($employee['id']) ?>"
            data-employee-name="<?= esc($employee['name']) ?>">

            <i class="bi bi-trash"></i>

        </button>

    <?php endif; ?>

</div>