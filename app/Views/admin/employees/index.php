<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Pegawai
            </h1>

            <p class="master-description">
                Kelola data pegawai dan bagian yang menjadi tujuan kunjungan tamu.
            </p>

        </div>

        <div class="master-header-actions">

            <button
                type="button"
                class="app-btn app-btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createEmployeeModal">

                <i class="bi bi-plus-lg"></i>

                Tambah Pegawai

            </button>

        </div>

    </div>

    <form
        action="<?= base_url('admin/employees') ?>"
        method="get"
        class="master-toolbar"
        id="employeesFilterForm">

        <div class="master-search">

            <i class="bi bi-search master-search-icon"></i>

            <input
                type="search"
                name="search"
                value=""
                class="master-search-input"
                placeholder="Cari nama, nomor HP, email, atau bagian..."
                autocomplete="off"
                id="employeesSearchInput">

        </div>

        <div class="master-filters">

            <select
                name="department_id"
                class="master-filter"
                id="employeesDepartmentFilter">

                <option value="">
                    Semua Bagian
                </option>

                <?php foreach (($departments ?? []) as $department): ?>

                    <option value="<?= esc($department['id']) ?>">
                        <?= esc($department['name']) ?>
                    </option>

                <?php endforeach; ?>

            </select>

            <select
                name="status"
                class="master-filter"
                id="employeesStatusFilter">

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
                id="employeesPerPageFilter">

                <?php foreach ([50, 100, 250, 500] as $option): ?>

                    <option value="<?= $option ?>">
                        <?= $option ?> data
                    </option>

                <?php endforeach; ?>

            </select>

            <button
                type="button"
                class="app-btn app-btn-ghost app-btn-sm"
                id="employeesResetFilter">

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>

        </div>

    </form>

    <div class="master-content-wrapper">

        <div
            class="master-loading-overlay"
            id="employeesLoading"
            hidden>
            <div class="app-loading">
                <div class="app-loading-spinner"></div>
                <span>Memuat data...</span>
            </div>
        </div>

        <div class="master-content" id="employeesContent">

            <?= view('admin/employees/_table', [
                'items' => $items ?? [],
                'pagination' => $pagination ?? null,
            ]) ?>

        </div>

    </div>

</div>

<?= view('admin/employees/create') ?>

<?= view('admin/employees/edit') ?>

<?= view('admin/employees/delete') ?>

<?= view('admin/employees/toggle') ?>

<?= view('admin/employees/restore') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/employees.js') ?>"></script>

<?= $this->endSection() ?>