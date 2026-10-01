<?php
$isDeleted = ! empty($user['deleted_at']);
$isActive = (int) $user['is_active'] === 1;

if ($isDeleted) {
    $statusLabel = 'Terhapus';
    $statusClass = 'app-badge-deleted';
} elseif ($isActive) {
    $statusLabel = 'Aktif';
    $statusClass = 'app-badge-active';
} else {
    $statusLabel = 'Nonaktif';
    $statusClass = 'app-badge-inactive';
}
?>

<span class="app-badge <?= esc($statusClass) ?>">
    <?= esc($statusLabel) ?>
</span>