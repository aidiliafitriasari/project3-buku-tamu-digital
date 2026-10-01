<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Pengguna
            </h1>

            <p class="master-description">
                Kelola akun Administrator dan Petugas sistem.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createUserModal"
                id="createUserButton">

                <i class="bi bi-plus-lg"></i>
                Tambah Pengguna

            </button>

        </div>

    </div>

    <form
        action="<?= base_url('admin/users') ?>"
        method="get"
        class="master-toolbar"
        id="usersFilterForm">

        <div class="master-search">

            <i class="bi bi-search master-search-icon"></i>

            <input
                type="search"
                name="search"
                value=""
                class="master-search-input"
                placeholder="Cari username atau email..."
                autocomplete="off"
                id="usersSearchInput">

        </div>

        <div class="master-filters">

            <select
                name="role"
                class="master-filter"
                id="usersRoleFilter">

                <option value="">
                    Semua Role
                </option>

                <option value="administrator">
                    Administrator
                </option>

                <option value="petugas">
                    Petugas
                </option>

            </select>

            <select
                name="status"
                class="master-filter"
                id="usersStatusFilter">

                <option value="">
                    Semua Status
                </option>

                <option value="active">
                    Aktif
                </option>

                <option value="inactive">
                    Nonaktif
                </option>

                <option value="deleted">
                    Terhapus
                </option>

            </select>

            <select
                name="per_page"
                class="master-filter"
                id="usersPerPageFilter">

                <?php foreach ([50, 100, 250, 500] as $option): ?>

                    <option value="<?= $option ?>">
                        <?= $option ?> data
                    </option>

                <?php endforeach; ?>

            </select>

            <button
                type="button"
                class="app-btn app-btn-ghost app-btn-sm"
                id="usersResetFilter">

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>

        </div>

    </form>

    <div class="master-content-wrapper">

        <div
            class="master-loading-overlay"
            id="usersLoading"
            hidden>
            <div class="app-loading">
                <div class="app-loading-spinner"></div>
                <span>Memuat data...</span>
            </div>
        </div>

        <div class="master-content" id="usersContent">

            <?= view('admin/users/_table', [
                'items' => $items ?? [],
                'pagination' => $pagination ?? null,
            ]) ?>

        </div>

    </div>

</div>

<?= view('admin/users/create') ?>

<?= view('admin/users/edit') ?>

<?= view('admin/users/show') ?>

<?= view('admin/users/reset_password') ?>

<?= view('admin/users/delete') ?>

<?= view('admin/users/toggle') ?>

<?= view('admin/users/restore') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/users.js') ?>"></script>

<?= $this->endSection() ?>