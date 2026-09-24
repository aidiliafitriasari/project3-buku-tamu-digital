<?php

$session = session();

$role     = $session->get('role');
$username = $session->get('username');

$isAdmin   = $role === 'administrator';
$isPetugas = $role === 'petugas';

$currentPath = trim(uri_string(), '/');
$currentStatus = service('request')->getGet('status');

$isActive = static function (
    string $path,
    ?string $status = null
) use ($currentPath, $currentStatus): string {

    $isPathActive = $currentPath === trim($path, '/');

    if (! $isPathActive) {
        return '';
    }

    if ($status === null) {
        return 'active';
    }

    return $currentStatus === $status
        ? 'active'
        : '';
};
?>

<aside class="panel-sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">

        <div class="sidebar-brand-icon">
            <i class="bi bi-building"></i>
        </div>

        <div class="sidebar-brand-text">
            <span class="brand-title">Buku Tamu</span>
            <span class="brand-subtitle">Digital</span>
        </div>

    </div>

    <!-- USER -->
    <div class="sidebar-user">

        <div class="sidebar-user-avatar">
            <i class="bi bi-person-fill"></i>
        </div>

        <div class="sidebar-user-info">

            <strong>
                <?= esc($username ?? 'Pengguna') ?>
            </strong>

            <span>
                <?= $isAdmin ? 'Administrator' : 'Petugas' ?>
            </span>

        </div>

    </div>

    <!-- NAVIGATION -->
    <nav class="sidebar-nav">

        <!-- DASHBOARD -->
        <div class="sidebar-section-title">
            Utama
        </div>

        <?php if ($isAdmin): ?>

            <a
                href="<?= base_url('admin/dashboard') ?>"
                class="sidebar-link <?= $isActive('admin/dashboard') ?>">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

        <?php elseif ($isPetugas): ?>

            <a
                href="<?= base_url('petugas/dashboard') ?>"
                class="sidebar-link <?= $isActive('petugas/dashboard') ?>">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>

        <?php endif; ?>

        <!-- ADMIN -->
        <?php if ($isAdmin): ?>

            <div class="sidebar-section-title">
                Administrasi
            </div>

            <a
                href="<?= base_url('admin/institution') ?>"
                class="sidebar-link <?= $isActive('admin/institution') ?>">
                <i class="bi bi-building"></i>
                <span>Identitas Instansi</span>
            </a>

            <!-- KUNJUNGAN -->
            <div class="sidebar-section-title">
                Kunjungan
            </div>

            <a
                href="<?= base_url('admin/visits') ?>"
                class="sidebar-link <?= $isActive('admin/visits') ?>">
                <i class="bi bi-journal-text"></i>
                <span>Semua Kunjungan</span>
            </a>

            <a
                href="<?= base_url('admin/visits?status=menunggu') ?>"
                class="sidebar-link <?= $isActive('admin/visits', 'menunggu') ?>">
                <i class="bi bi-hourglass-split"></i>
                <span>Menunggu</span>
            </a>

            <a
                href="<?= base_url('admin/visits?status=masih_berkunjung') ?>"
                class="sidebar-link <?= $isActive('admin/visits', 'masih_berkunjung') ?>">
                <i class="bi bi-person-walking"></i>
                <span>Masih Berkunjung</span>
            </a>

            <a
                href="<?= base_url('admin/visits?status=selesai') ?>"
                class="sidebar-link <?= $isActive('admin/visits', 'selesai') ?>">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat</span>
            </a>

            <!-- MASTER DATA -->
            <div class="sidebar-section-title">
                Master Data
            </div>

            <a
                href="<?= base_url('admin/users') ?>"
                class="sidebar-link <?= $isActive('admin/users') ?>">
                <i class="bi bi-people"></i>
                <span>Pengguna</span>
            </a>

            <a
                href="<?= base_url('admin/employees') ?>"
                class="sidebar-link <?= $isActive('admin/employees') ?>">
                <i class="bi bi-person-badge"></i>
                <span>Pegawai</span>
            </a>

            <a
                href="<?= base_url('admin/departments') ?>"
                class="sidebar-link <?= $isActive('admin/departments') ?>">
                <i class="bi bi-diagram-3"></i>
                <span>Departemen</span>
            </a>

            <a
                href="<?= base_url('admin/visit-purposes') ?>"
                class="sidebar-link <?= $isActive('admin/visit-purposes') ?>">
                <i class="bi bi-card-checklist"></i>
                <span>Keperluan Kunjungan</span>
            </a>

            <!-- LAINNYA -->
            <div class="sidebar-section-title">
                Sistem
            </div>

            <a
                href="<?= base_url('admin/reports') ?>"
                class="sidebar-link <?= $isActive('admin/reports') ?>">
                <i class="bi bi-bar-chart"></i>
                <span>Laporan</span>
            </a>

            <a
                href="<?= base_url('admin/activity-logs') ?>"
                class="sidebar-link <?= $isActive('admin/activity-logs') ?>">
                <i class="bi bi-activity"></i>
                <span>Activity Log</span>
            </a>

            <a
                href="<?= base_url('admin/settings') ?>"
                class="sidebar-link <?= $isActive('admin/settings') ?>">
                <i class="bi bi-gear"></i>
                <span>Pengaturan</span>
            </a>

        <?php endif; ?>

        <!-- PETUGAS -->
        <?php if ($isPetugas): ?>

            <div class="sidebar-section-title">
                Kunjungan
            </div>

            <a
                href="<?= base_url('petugas/visits?status=menunggu') ?>"
                class="sidebar-link <?= $isActive('petugas/visits', 'menunggu') ?>">
                <i class="bi bi-hourglass-split"></i>
                <span>Menunggu</span>
            </a>

            <a
                href="<?= base_url('petugas/visits?status=masih_berkunjung') ?>"
                class="sidebar-link <?= $isActive('petugas/visits', 'masih_berkunjung') ?>">
                <i class="bi bi-person-walking"></i>
                <span>Masih Berkunjung</span>
            </a>

            <a
                href="<?= base_url('petugas/visits?status=selesai') ?>"
                class="sidebar-link <?= $isActive('petugas/visits', 'selesai') ?>">
                <i class="bi bi-clock-history"></i>
                <span>Riwayat</span>
            </a>

        <?php endif; ?>

    </nav>

    <!-- LOGOUT -->
    <div class="sidebar-footer">

        <form
            action="<?= base_url('logout') ?>"
            method="post">
            <?= csrf_field() ?>

            <button
                type="submit"
                class="sidebar-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>

        </form>

    </div>

</aside>