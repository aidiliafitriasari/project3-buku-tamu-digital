<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Bagian/Departemen
            </h1>

            <p class="master-description">
                Kelola data bagian atau departemen yang tersedia.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createDepartmentModal">

                <i class="bi bi-plus-lg"></i>

                Tambah Bagian

            </button>

        </div>

    </div>

    <form
        action="<?= base_url('admin/departments') ?>"
        method="get"
        class="master-toolbar"
        id="departmentsFilterForm">

        <div class="master-search">

            <i class="bi bi-search master-search-icon"></i>

            <input
                type="search"
                name="search"
                value=""
                class="master-search-input"
                placeholder="Cari nama bagian..."
                autocomplete="off"
                id="departmentsSearchInput">

        </div>

        <div class="master-filters">

            <select
                name="status"
                class="master-filter"
                id="departmentsStatusFilter">

                <option value="">
                    Semua Status
                </option>

                <option value="active">
                    Aktif
                </option>

                <option value="inactive">
                    Tidak Aktif
                </option>

                <option value="deleted">
                    Terhapus
                </option>

            </select>

            <select
                name="per_page"
                class="master-filter"
                id="departmentsPerPageFilter">

                <?php foreach ([50, 100, 250, 500] as $option): ?>

                    <option value="<?= $option ?>">
                        <?= $option ?> data
                    </option>

                <?php endforeach; ?>

            </select>

            <button
                type="button"
                class="app-btn app-btn-ghost app-btn-sm"
                id="departmentsResetFilter">

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>

        </div>

    </form>

    <div class="master-content-wrapper">

        <div
            class="master-loading-overlay"
            id="departmentsLoading"
            hidden>
            <div class="app-loading">
                <div class="app-loading-spinner"></div>
                <span>Memuat data...</span>
            </div>
        </div>

        <div class="master-content" id="departmentsContent">

            <?= view('admin/departments/_table', [
                'items' => $items ?? [],
                'pagination' => $pagination ?? null,
            ]) ?>

        </div>

    </div>

</div>

<?= view('admin/departments/create') ?>

<?= view('admin/departments/edit') ?>

<?= view('admin/departments/delete') ?>

<?= view('admin/departments/toggle') ?>

<?= view('admin/departments/restore') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/departments.js') ?>"></script>

<?= $this->endSection() ?>