<?php
$isDeleted = ! empty($employee['deleted_at']);
$isActive = (int) $employee['is_active'] === 1;

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