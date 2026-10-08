<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$isRiwayatMenu = in_array($status, ['riwayat', 'selesai', 'ditolak', 'dibatalkan'], true);
$isAktifMenu   = in_array($status, ['aktif', 'menunggu', 'masih_berkunjung'], true);

$menuParam = $_GET['menu'] ?? null;

if ($menuParam === 'riwayat') {
    $isRiwayatMenu = true;
    $isAktifMenu = false;
} elseif ($menuParam === 'aktif') {
    $isRiwayatMenu = false;
    $isAktifMenu = true;
}
?>

<div class="master-page">

    <!-- HEADER -->
    <div class="master-header">

        <div class="master-header-info">
            <h1 class="master-title">
                <?php if ($status === 'aktif'): ?>
                    Kunjungan Aktif
                <?php elseif ($status === 'riwayat'): ?>
                    Riwayat Kunjungan
                <?php elseif ($status === 'menunggu'): ?>
                    Kunjungan Menunggu
                <?php elseif ($status === 'masih_berkunjung'): ?>
                    Masih Berkunjung
                <?php elseif ($status === 'selesai'): ?>
                    Kunjungan Selesai
                <?php elseif ($status === 'ditolak'): ?>
                    Kunjungan Ditolak
                <?php elseif ($status === 'dibatalkan'): ?>
                    Kunjungan Dibatalkan
                <?php elseif ($status === 'terhapus'): ?>
                    Kunjungan Terhapus
                <?php else: ?>
                    Kunjungan
                <?php endif; ?>
            </h1>

            <p class="master-description">
                <?php if ($status === 'aktif'): ?>
                    Tamu yang menunggu atau sedang berada di lokasi.
                <?php elseif ($status === 'riwayat'): ?>
                    Riwayat kunjungan yang telah selesai, ditolak, atau dibatalkan.
                <?php elseif ($status === 'menunggu'): ?>
                    Tamu yang menunggu verifikasi check-in.
                <?php elseif ($status === 'masih_berkunjung'): ?>
                    Tamu yang masih berada di lokasi.
                <?php elseif ($status === 'selesai'): ?>
                    Kunjungan yang telah selesai.
                <?php elseif ($status === 'ditolak'): ?>
                    Kunjungan yang ditolak.
                <?php elseif ($status === 'dibatalkan'): ?>
                    Kunjungan yang dibatalkan.
                <?php elseif ($status === 'terhapus'): ?>
                    Kunjungan yang telah dihapus (soft delete).
                <?php else: ?>
                    Daftar kunjungan tamu.
                <?php endif; ?>
            </p>
        </div>

    </div>

    <!-- FILTER -->
    <form
        action="<?= base_url($isAdmin ?? false ? 'admin/visits' : 'petugas/visits') ?>"
        method="get"
        class="master-toolbar"
        id="visitsFilterForm">

        <div class="master-search">
            <i class="bi bi-search master-search-icon"></i>
            <input
                type="search"
                name="search"
                value="<?= esc($search) ?>"
                class="master-search-input"
                placeholder="Cari nama tamu, kode kunjungan, atau nomor HP..."
                autocomplete="off"
                id="visitsSearchInput">
        </div>

        <div class="master-filters">
            <input type="hidden" name="menu" value="<?= $isRiwayatMenu ? 'riwayat' : 'aktif' ?>">

            <select
                name="status"
                class="master-filter"
                id="visitsStatusFilter">

                <?php if ($isRiwayatMenu): ?>

                    <!-- Submenu Riwayat -->
                    <option value="riwayat" <?= $status === 'riwayat' ? 'selected' : '' ?>>Riwayat</option>
                    <option value="selesai" <?= $status === 'selesai' ? 'selected' : '' ?>>Selesai</option>
                    <option value="ditolak" <?= $status === 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                    <option value="dibatalkan" <?= $status === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                    <?php if (! empty($isAdmin)): ?>
                        <option value="terhapus" <?= $status === 'terhapus' ? 'selected' : '' ?>>Terhapus</option>
                    <?php endif; ?>

                <?php else: ?>

                    <!-- Submenu Aktif -->
                    <option value="aktif" <?= $status === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="menunggu" <?= $status === 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                    <option value="masih_berkunjung" <?= $status === 'masih_berkunjung' ? 'selected' : '' ?>>Masih Berkunjung</option>
                    <?php if (! empty($isAdmin)): ?>
                        <option value="terhapus" <?= $status === 'terhapus' ? 'selected' : '' ?>>Terhapus</option>
                    <?php endif; ?>

                <?php endif; ?>

            </select>

            <!-- FILTER DEPARTEMEN -->
            <select
                name="department_id"
                class="master-filter"
                id="visitsDepartmentFilter">
                <option value="">Semua Departemen</option>
                <?php foreach ($departments as $dept): ?>
                    <option
                        value="<?= esc($dept['id']) ?>"
                        <?= (int) $deptId === (int) $dept['id'] ? 'selected' : '' ?>>
                        <?= esc($dept['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- FILTER PEGAWAI — DISABLE SAMPAI DEPARTEMEN DIPILIH -->
            <select
                name="employee_id"
                class="master-filter"
                id="visitsEmployeeFilter"
                data-selected="<?= esc($empId) ?>"
                <?= $deptId === 0 ? 'disabled' : '' ?>>
                <?php if ($deptId === 0): ?>
                    <option value="">Pilih departemen dulu</option>
                <?php else: ?>
                    <option value="">Semua Pegawai</option>
                    <?php foreach ($employees as $emp): ?>
                        <?php if ((int) $emp['department_id'] === $deptId): ?>
                            <option
                                value="<?= esc($emp['id']) ?>"
                                <?= (int) $empId === (int) $emp['id'] ? 'selected' : '' ?>>
                                <?= esc($emp['name']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

            <!-- FILTER PER PAGE -->
            <select
                name="per_page"
                class="master-filter"
                id="visitsPerPageFilter">
                <?php foreach ([50, 100, 250, 500] as $option): ?>
                    <option
                        value="<?= $option ?>"
                        <?= (int) $perPage === $option ? 'selected' : '' ?>>
                        <?= $option ?> data
                    </option>
                <?php endforeach; ?>
            </select>

            <button
                type="button"
                class="app-btn app-btn-ghost app-btn-sm"
                id="visitsResetFilter">
                <i class="bi bi-arrow-counterclockwise"></i>
                Reset
            </button>

        </div>

    </form>

    <!-- CONTENT -->
    <div class="master-content-wrapper">

        <div
            class="master-loading-overlay"
            id="visitsLoading"
            hidden>
            <div class="app-loading">
                <div class="app-loading-spinner"></div>
                <span>Memuat data...</span>
            </div>
        </div>

        <div class="master-content" id="visitsContent">

            <?= view('petugas/visits/_table', [
                'items'      => $items ?? [],
                'pagination' => $pagination ?? null,
                'status'     => $status,
                'isAdmin'    => $isAdmin ?? false,
            ]) ?>

        </div>

    </div>

</div>

<!-- MODAL -->
<?= view('petugas/visits/verify') ?>
<?= view('petugas/visits/reject') ?>
<?= view('petugas/visits/cancel') ?>
<?= view('petugas/visits/checkout') ?>
<?= view('petugas/visits/edit') ?>
<?= view('petugas/visits/_delete') ?>
<?= view('petugas/visits/_restore') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    window.visitsEmployeesData = <?= json_encode($employees ?? []) ?>;
</script>
<script src="<?= base_url('assets/js/petugas-visits.js') ?>"></script>
<?= $this->endSection() ?>