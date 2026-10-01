<?php
$containerClass = $containerClass ?? 'master-table-actions';
$isDeleted = ! empty($department['deleted_at']);
$isActive = (int) $department['is_active'] === 1;
?>

<div class="<?= esc($containerClass) ?>">

    <?php if ($isDeleted): ?>

        <button
            type="button"
            class="app-icon-button"
            title="Pulihkan"
            aria-label="Pulihkan bagian"
            data-bs-toggle="modal"
            data-bs-target="#restoreDepartmentModal"
            data-department-id="<?= esc($department['id']) ?>"
            data-department-name="<?= esc($department['name']) ?>">

            <i class="bi bi-arrow-counterclockwise"></i>

        </button>

    <?php else: ?>

        <button
            type="button"
            class="app-icon-button"
            title="Edit"
            aria-label="Edit bagian"
            data-bs-toggle="modal"
            data-bs-target="#editDepartmentModal"
            data-department-id="<?= esc($department['id']) ?>"
            data-department-name="<?= esc($department['name']) ?>">

            <i class="bi bi-pencil"></i>

        </button>

        <?php if ($isActive): ?>

            <button
                type="button"
                class="app-icon-button"
                title="Nonaktifkan"
                aria-label="Nonaktifkan bagian"
                data-bs-toggle="modal"
                data-bs-target="#toggleDepartmentModal"
                data-department-id="<?= esc($department['id']) ?>"
                data-department-name="<?= esc($department['name']) ?>"
                data-is-active="1"
                data-status-label="Aktif">

                <i class="bi bi-toggle-on"></i>

            </button>

        <?php else: ?>

            <button
                type="button"
                class="app-icon-button"
                title="Aktifkan"
                aria-label="Aktifkan bagian"
                data-bs-toggle="modal"
                data-bs-target="#toggleDepartmentModal"
                data-department-id="<?= esc($department['id']) ?>"
                data-department-name="<?= esc($department['name']) ?>"
                data-is-active="0"
                data-status-label="Tidak Aktif">

                <i class="bi bi-toggle-off"></i>

            </button>

        <?php endif; ?>

        <button
            type="button"
            class="app-icon-button app-icon-button-danger"
            title="Hapus"
            aria-label="Hapus bagian"
            data-bs-toggle="modal"
            data-bs-target="#deleteDepartmentModal"
            data-department-id="<?= esc($department['id']) ?>"
            data-department-name="<?= esc($department['name']) ?>">

            <i class="bi bi-trash"></i>

        </button>

    <?php endif; ?>

</div>