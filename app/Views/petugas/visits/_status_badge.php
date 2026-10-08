<?php
$visit       = $visit ?? [];
$isDeleted   = ! empty($visit['deleted_at']);

if ($isDeleted) {
    $data = [
        'label' => 'Terhapus',
        'class' => 'app-badge-deleted',
        'icon'  => 'bi-trash',
    ];
} else {
    $status = $visit['status'] ?? null;

    $map = [
        'menunggu' => [
            'label' => 'Menunggu',
            'class' => 'app-badge-menunggu',
            'icon'  => 'bi-hourglass-split',
        ],
        'masih_berkunjung' => [
            'label' => 'Masih Berkunjung',
            'class' => 'app-badge-berkunjung',
            'icon'  => 'bi-person-check',
        ],
        'selesai' => [
            'label' => 'Selesai',
            'class' => 'app-badge-selesai',
            'icon'  => 'bi-check-circle',
        ],
        'ditolak' => [
            'label' => 'Ditolak',
            'class' => 'app-badge-ditolak',
            'icon'  => 'bi-x-circle',
        ],
        'dibatalkan' => [
            'label' => 'Dibatalkan',
            'class' => 'app-badge-dibatalkan',
            'icon'  => 'bi-slash-circle',
        ],
    ];

    $data = $map[$status] ?? [
        'label' => ucfirst($status ?? '-'),
        'class' => 'app-badge-inactive',
        'icon'  => 'bi-question-circle',
    ];
}
?>

<span class="app-badge <?= esc($data['class']) ?>">
    <i class="bi <?= esc($data['icon']) ?>"></i>
    <?= esc($data['label']) ?>
</span>