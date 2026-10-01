<?php
$isDeleted = ! empty($department['deleted_at']);
$isActive = (int) $department['is_active'] === 1;

if ($isDeleted) {
    $statusLabel = 'Terhapus';
    $statusClass = 'app-badge-deleted';
} elseif ($isActive) {
    $statusLabel = 'Aktif';
    $statusClass = 'app-badge-active';
} else {
    $statusLabel = 'Tidak Aktif';
    $statusClass = 'app-badge-inactive';
}
?>

<span class="app-badge <?= esc($statusClass) ?>">
    <?= esc($statusLabel) ?>
</span>