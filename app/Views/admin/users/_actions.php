<?php
$containerClass = $containerClass ?? 'master-table-actions';
?>

<div class="<?= esc($containerClass) ?>">

    <button
        type="button"
        class="app-icon-button"
        title="Detail"
        aria-label="Detail pengguna"
        data-bs-toggle="modal"
        data-bs-target="#showUserModal"
        data-user-id="<?= esc($user['id']) ?>"
        data-username="<?= esc($user['username']) ?>"
        data-email="<?= esc($user['email']) ?>"
        data-nomor-hp="<?= esc($user['nomor_hp']) ?>"
        data-role="<?= esc($user['role'] === 'administrator' ? 'Administrator' : 'Petugas') ?>"
        data-status="<?= esc(! empty($user['deleted_at']) ? 'Terhapus' : ((int) $user['is_active'] === 1 ? 'Aktif' : 'Nonaktif')) ?>"
        data-created-at="<?= esc($user['created_at']) ?>"
        data-updated-at="<?= esc($user['updated_at']) ?>"
        data-deleted-at="<?= esc($user['deleted_at'] ?? '') ?>">

        <i class="bi bi-eye"></i>

    </button>

    <?php if (empty($user['deleted_at'])): ?>

        <button
            type="button"
            class="app-icon-button"
            title="Edit"
            aria-label="Edit pengguna"
            data-bs-toggle="modal"
            data-bs-target="#editUserModal"
            data-user-id="<?= esc($user['id']) ?>"
            data-username="<?= esc($user['username']) ?>"
            data-email="<?= esc($user['email']) ?>"
            data-nomor-hp="<?= esc($user['nomor_hp']) ?>"
            data-role="<?= esc($user['role']) ?>">

            <i class="bi bi-pencil"></i>

        </button>

        <button
            type="button"
            class="app-icon-button"
            title="Reset Password"
            aria-label="Reset password pengguna"
            data-bs-toggle="modal"
            data-bs-target="#resetPasswordModal"
            data-user-id="<?= esc($user['id']) ?>"
            data-username="<?= esc($user['username']) ?>"
            data-email="<?= esc($user['email']) ?>">

            <i class="bi bi-key"></i>

        </button>

        <!-- TOGGLE STATUS -->
        <?php if ((int) $user['is_active'] === 1): ?>

            <button
                type="button"
                class="app-icon-button"
                title="Nonaktifkan"
                aria-label="Nonaktifkan pengguna"
                data-bs-toggle="modal"
                data-bs-target="#toggleUserModal"
                data-user-id="<?= esc($user['id']) ?>"
                data-username="<?= esc($user['username']) ?>"
                data-email="<?= esc($user['email']) ?>"
                data-is-active="1"
                data-status-label="Aktif">

                <i class="bi bi-toggle-on"></i>

            </button>

        <?php else: ?>

            <button
                type="button"
                class="app-icon-button"
                title="Aktifkan"
                aria-label="Aktifkan pengguna"
                data-bs-toggle="modal"
                data-bs-target="#toggleUserModal"
                data-user-id="<?= esc($user['id']) ?>"
                data-username="<?= esc($user['username']) ?>"
                data-email="<?= esc($user['email']) ?>"
                data-is-active="0"
                data-status-label="Nonaktif">

                <i class="bi bi-toggle-off"></i>

            </button>

        <?php endif; ?>

        <button
            type="button"
            class="app-icon-button app-icon-button-danger"
            title="Hapus"
            aria-label="Hapus pengguna"
            data-bs-toggle="modal"
            data-bs-target="#deleteUserModal"
            data-user-id="<?= esc($user['id']) ?>"
            data-username="<?= esc($user['username']) ?>"
            data-email="<?= esc($user['email']) ?>">

            <i class="bi bi-trash"></i>

        </button>

    <?php else: ?>

        <button
            type="button"
            class="app-icon-button"
            title="Pulihkan"
            aria-label="Pulihkan pengguna"
            data-bs-toggle="modal"
            data-bs-target="#restoreUserModal"
            data-user-id="<?= esc($user['id']) ?>"
            data-username="<?= esc($user['username']) ?>"
            data-email="<?= esc($user['email']) ?>">

            <i class="bi bi-arrow-counterclockwise"></i>

        </button>

    <?php endif; ?>

</div>