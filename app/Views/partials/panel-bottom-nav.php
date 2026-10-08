<?php

$session = session();

$role     = $session->get('role');

$isAdmin   = $role === 'administrator';
$isPetugas = $role === 'petugas';

$currentPath = trim(uri_string(), '/');

$isActive = static function (string $path) use ($currentPath): string {
    $isPathActive = strpos($currentPath, trim($path, '/')) === 0;

    return $isPathActive ? 'active' : '';
};

if ($isAdmin) {
    $dashboardUrl = base_url('admin/dashboard');
} else {
    $dashboardUrl = base_url('petugas/dashboard');
}

$visitsUrl = $isAdmin
    ? base_url('admin/visits')
    : base_url('petugas/visits');
?>

<nav class="bottom-nav" aria-label="Navigasi utama">

    <!-- DASHBOARD -->
    <a
        href="<?= $dashboardUrl ?>"
        class="bottom-nav-item <?= $isActive($isAdmin ? 'admin/dashboard' : 'petugas/dashboard') ?>">

        <i class="bi bi-grid-1x2"></i>
        <span>Dashboard</span>

    </a>

    <!-- KUNJUNGAN -->
    <a
        href="<?= $visitsUrl ?>"
        class="bottom-nav-item <?= $isActive($isAdmin ? 'admin/visits' : 'petugas/visits') ?>">

        <i class="bi bi-journal-text"></i>
        <span>Kunjungan</span>

    </a>

    <?php if ($isPetugas): ?>

        <!-- SCAN QR -->
        <a
            href="<?= base_url('petugas/checkout') ?>"
            class="bottom-nav-item <?= $isActive('petugas/checkout') ?>">

            <i class="bi bi-qr-code-scan"></i>
            <span>Scan QR</span>

        </a>

    <?php endif; ?>

    <!-- MENU -->
    <button
        type="button"
        class="bottom-nav-item"
        id="bottomNavMenuBtn">

        <i class="bi bi-list"></i>
        <span>Menu</span>

    </button>

</nav>