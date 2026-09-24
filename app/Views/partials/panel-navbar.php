<?php

$session = session();

$role     = $session->get('role');
$username = $session->get('username');

$isAdmin   = $role === 'administrator';
$isPetugas = $role === 'petugas';

$currentPath = trim(uri_string(), '/');

if ($isAdmin) {
    $dashboardUrl = base_url('admin/dashboard');
    $roleLabel    = 'Administrator';
} else {
    $dashboardUrl = base_url('petugas/dashboard');
    $roleLabel    = 'Petugas';
}
?>

<header class="panel-navbar">

    <!-- MOBILE MENU BUTTON -->
    <button
        type="button"
        class="sidebar-toggle"
        id="sidebarToggle"
        aria-label="Buka menu">
        <i class="bi bi-list"></i>
    </button>

    <!-- PAGE INFO -->
    <div class="navbar-page-info">

        <a
            href="<?= $dashboardUrl ?>"
            class="navbar-home"
            aria-label="Dashboard">
            <i class="bi bi-house"></i>
        </a>

        <div class="navbar-divider"></div>

        <div>
            <span class="navbar-label">
                Panel
            </span>

            <span class="navbar-role">
                <?= esc($roleLabel) ?>
            </span>
        </div>

    </div>

    <!-- RIGHT SIDE -->
    <div class="navbar-actions">

        <!-- ROLE BADGE -->
        <div class="navbar-role-badge">

            <span class="navbar-role-dot"></span>

            <span>
                <?= esc($roleLabel) ?>
            </span>

        </div>

        <!-- USER -->
        <div class="navbar-user">

            <div class="navbar-user-avatar">
                <i class="bi bi-person-fill"></i>
            </div>

            <div class="navbar-user-info">

                <strong>
                    <?= esc($username ?? 'Pengguna') ?>
                </strong>

                <span>
                    <?= esc($roleLabel) ?>
                </span>

            </div>

        </div>

        <!-- LOGOUT -->
        <form
            action="<?= base_url('logout') ?>"
            method="post"
            class="navbar-logout-form">
            <?= csrf_field() ?>

            <button
                type="submit"
                class="navbar-logout"
                aria-label="Logout"
                title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>

        </form>

    </div>

</header>

<!-- MOBILE SIDEBAR OVERLAY -->
<div
    class="sidebar-overlay"
    id="sidebarOverlay"></div>