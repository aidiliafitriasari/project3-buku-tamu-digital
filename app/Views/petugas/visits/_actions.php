<?php
$visit        = $visit ?? [];
$isAdmin      = $isAdmin ?? false;
$statusFilter = $statusFilter ?? null;

$visitId     = (int) ($visit['id'] ?? 0);
$visitCode   = $visit['visit_code'] ?? '';
$guestName   = $visit['guest_name'] ?? '';
$visitStatus = $visit['status'] ?? null;
$isDeleted   = ! empty($visit['deleted_at']);
$isTerhapus  = $isDeleted || ($statusFilter === 'terhapus');

$menuParam = in_array($statusFilter, ['riwayat', 'selesai', 'ditolak', 'dibatalkan'], true)
    ? 'riwayat'
    : 'aktif';

$fromFilter = $statusFilter ?? 'aktif';

$editableStatuses  = ['menunggu'];
$deletableStatuses = ['menunggu', 'selesai', 'ditolak', 'dibatalkan'];
?>

<div class="master-table-actions">

    <!-- DETAIL -->
    <a href="<?= base_url(($isAdmin ? 'admin' : 'petugas') . '/visits/' . $visitId . '?from=' . urlencode($fromFilter) . '&menu=' . urlencode($menuParam)) ?>"
        class="app-icon-button"
        title="Detail Kunjungan">
        <i class="bi bi-eye"></i>
    </a>

    <?php if ($isTerhapus && $isAdmin): ?>

        <button type="button"
            class="app-icon-button app-icon-button-success"
            title="Pulihkan Kunjungan"
            data-bs-toggle="modal"
            data-bs-target="#restoreVisitModal"
            data-visit-id="<?= esc($visitId) ?>"
            data-visit-code="<?= esc($visitCode) ?>"
            data-guest-name="<?= esc($guestName) ?>">
            <i class="bi bi-arrow-counterclockwise"></i>
        </button>

    <?php elseif (! $isTerhapus): ?>

        <?php if (in_array($visitStatus, $editableStatuses, true)): ?>
            <button type="button"
                class="app-icon-button"
                title="Edit Kunjungan"
                data-bs-toggle="modal"
                data-bs-target="#editVisitModal"
                data-visit-id="<?= esc($visitId) ?>">
                <i class="bi bi-pencil"></i>
            </button>
        <?php endif; ?>

        <?php if ($visitStatus === 'menunggu'): ?>
            <button type="button"
                class="app-icon-button"
                title="Proses Verifikasi"
                data-bs-toggle="modal"
                data-bs-target="#verifyVisitModal"
                data-visit-id="<?= esc($visitId) ?>"
                data-visit-code="<?= esc($visitCode) ?>"
                data-guest-name="<?= esc($guestName) ?>">
                <i class="bi bi-clipboard-check"></i>
            </button>

            <button type="button"
                class="app-icon-button app-icon-button-danger"
                title="Batalkan Kunjungan"
                data-bs-toggle="modal"
                data-bs-target="#cancelVisitModal"
                data-visit-id="<?= esc($visitId) ?>"
                data-visit-code="<?= esc($visitCode) ?>"
                data-guest-name="<?= esc($guestName) ?>">
                <i class="bi bi-slash-circle"></i>
            </button>
        <?php elseif ($visitStatus === 'masih_berkunjung'): ?>
            <button type="button"
                class="app-icon-button"
                title="Checkout"
                data-bs-toggle="modal"
                data-bs-target="#checkoutVisitModal"
                data-visit-id="<?= esc($visitId) ?>"
                data-visit-code="<?= esc($visitCode) ?>"
                data-guest-name="<?= esc($guestName) ?>">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        <?php endif; ?>

        <?php if ($isAdmin && in_array($visitStatus, $deletableStatuses, true)): ?>
            <button type="button"
                class="app-icon-button app-icon-button-danger"
                title="Hapus Kunjungan"
                data-bs-toggle="modal"
                data-bs-target="#deleteVisitModal"
                data-visit-id="<?= esc($visitId) ?>"
                data-visit-code="<?= esc($visitCode) ?>"
                data-guest-name="<?= esc($guestName) ?>">
                <i class="bi bi-trash"></i>
            </button>
        <?php endif; ?>

    <?php endif; ?>

</div>