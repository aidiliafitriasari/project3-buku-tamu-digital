<?php
$containerClass = $containerClass ?? 'master-table-actions';
$isDeleted = ! empty($purpose['deleted_at']);
$isActive = (int) $purpose['is_active'] === 1;
?>

<div class="<?= esc($containerClass) ?>">

    <?php if ($isDeleted): ?>

        <button
            type="button"
            class="app-icon-button"
            title="Pulihkan"
            aria-label="Pulihkan keperluan"
            data-bs-toggle="modal"
            data-bs-target="#restoreVisitPurposeModal"
            data-purpose-id="<?= esc($purpose['id']) ?>"
            data-purpose-name="<?= esc($purpose['name']) ?>">

            <i class="bi bi-arrow-counterclockwise"></i>

        </button>

    <?php else: ?>

        <button
            type="button"
            class="app-icon-button"
            title="Edit"
            aria-label="Edit keperluan"
            data-bs-toggle="modal"
            data-bs-target="#editVisitPurposeModal"
            data-purpose-id="<?= esc($purpose['id']) ?>"
            data-purpose-name="<?= esc($purpose['name']) ?>">

            <i class="bi bi-pencil"></i>

        </button>

        <?php if ($isActive): ?>

            <button
                type="button"
                class="app-icon-button"
                title="Nonaktifkan"
                aria-label="Nonaktifkan keperluan"
                data-bs-toggle="modal"
                data-bs-target="#toggleVisitPurposeModal"
                data-purpose-id="<?= esc($purpose['id']) ?>"
                data-purpose-name="<?= esc($purpose['name']) ?>"
                data-is-active="1"
                data-status-label="Aktif">

                <i class="bi bi-toggle-on"></i>

            </button>

        <?php else: ?>

            <button
                type="button"
                class="app-icon-button"
                title="Aktifkan"
                aria-label="Aktifkan keperluan"
                data-bs-toggle="modal"
                data-bs-target="#toggleVisitPurposeModal"
                data-purpose-id="<?= esc($purpose['id']) ?>"
                data-purpose-name="<?= esc($purpose['name']) ?>"
                data-is-active="0"
                data-status-label="Tidak Aktif">

                <i class="bi bi-toggle-off"></i>

            </button>

        <?php endif; ?>

        <button
            type="button"
            class="app-icon-button app-icon-button-danger"
            title="Hapus"
            aria-label="Hapus keperluan"
            data-bs-toggle="modal"
            data-bs-target="#deleteVisitPurposeModal"
            data-purpose-id="<?= esc($purpose['id']) ?>"
            data-purpose-name="<?= esc($purpose['name']) ?>">

            <i class="bi bi-trash"></i>

        </button>

    <?php endif; ?>

</div>