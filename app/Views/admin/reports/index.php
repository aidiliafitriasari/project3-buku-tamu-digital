<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/reports/reports.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="report-page">

    <!-- HEADER -->
    <div class="report-header">

        <div class="report-header-info">
            <h1 class="report-title">Laporan Kunjungan</h1>
            <p class="report-description">
                Analisis data kunjungan berdasarkan periode dan filter.
            </p>
        </div>

        <div class="report-header-actions">
            <a href="#" data-url="<?= site_url('admin/reports/print') ?>"
                target="_blank"
                id="reportPrintBtn"
                class="app-btn app-btn-ghost">
                <i class="bi bi-printer"></i>
                Cetak
            </a>

            <a href="#" data-url="<?= site_url('admin/reports/export') ?>"
                data-format="pdf"
                id="reportPdfBtn"
                class="app-btn app-btn-ghost">
                <i class="bi bi-file-earmark-pdf"></i>
                PDF
            </a>

            <a href="#" data-url="<?= site_url('admin/reports/export') ?>"
                data-format="excel"
                id="reportExcelBtn"
                class="app-btn app-btn-primary">
                <i class="bi bi-file-earmark-excel"></i>
                Excel
            </a>
        </div>

    </div>

    <!-- FILTER -->
    <div class="report-filter">

        <form id="reportFilterForm" class="report-filter-form">

            <div class="report-filter-group">
                <label>Periode</label>
                <select name="period" id="filter_period" class="report-filter-input">
                    <option value="harian" <?= $filters['period'] === 'harian'   ? 'selected' : '' ?>>Harian</option>
                    <option value="mingguan" <?= $filters['period'] === 'mingguan' ? 'selected' : '' ?>>Mingguan</option>
                    <option value="bulanan" <?= $filters['period'] === 'bulanan'  ? 'selected' : '' ?>>Bulanan</option>
                    <option value="custom" <?= $filters['period'] === 'custom'   ? 'selected' : '' ?>>Custom</option>
                </select>
            </div>

            <div class="report-filter-group report-filter-custom <?= $filters['period'] === 'custom' ? '' : 'is-hidden' ?>">
                <label>Dari</label>
                <input type="date" name="date_from" id="filter_date_from"
                    class="report-filter-input"
                    value="<?= esc($filters['date_from']) ?>">
            </div>

            <div class="report-filter-group report-filter-custom <?= $filters['period'] === 'custom' ? '' : 'is-hidden' ?>">
                <label>Sampai</label>
                <input type="date" name="date_to" id="filter_date_to"
                    class="report-filter-input"
                    value="<?= esc($filters['date_to']) ?>">
            </div>

            <div class="report-filter-group">
                <label>Departemen</label>
                <select name="department_id" class="report-filter-input">
                    <option value="">Semua</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= esc($dept['id']) ?>"
                            <?= (int) $filters['department_id'] === (int) $dept['id'] ? 'selected' : '' ?>>
                            <?= esc($dept['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="report-filter-group">
                <label>Pegawai</label>
                <select name="employee_id" class="report-filter-input">
                    <option value="">Semua</option>
                    <?php foreach ($employees as $emp): ?>
                        <option value="<?= esc($emp['id']) ?>"
                            <?= (int) $filters['employee_id'] === (int) $emp['id'] ? 'selected' : '' ?>>
                            <?= esc($emp['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="report-filter-group">
                <label>Asal Instansi</label>
                <input type="text" name="origin_institution"
                    class="report-filter-input"
                    value="<?= esc($filters['origin_institution']) ?>"
                    placeholder="Cari instansi...">
            </div>

            <div class="report-filter-group">
                <label>Keperluan</label>
                <select name="visit_purpose_id" class="report-filter-input">
                    <option value="">Semua</option>
                    <?php foreach ($purposes as $p): ?>
                        <option value="<?= esc($p['id']) ?>"
                            <?= (int) $filters['visit_purpose_id'] === (int) $p['id'] ? 'selected' : '' ?>>
                            <?= esc($p['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="report-filter-group">
                <label>Status</label>
                <select name="status" class="report-filter-input">
                    <option value="">Semua</option>
                    <option value="menunggu" <?= $filters['status'] === 'menunggu'          ? 'selected' : '' ?>>Menunggu</option>
                    <option value="masih_berkunjung" <?= $filters['status'] === 'masih_berkunjung' ? 'selected' : '' ?>>Masih Berkunjung</option>
                    <option value="selesai" <?= $filters['status'] === 'selesai'          ? 'selected' : '' ?>>Selesai</option>
                    <option value="ditolak" <?= $filters['status'] === 'ditolak'          ? 'selected' : '' ?>>Ditolak</option>
                    <option value="dibatalkan" <?= $filters['status'] === 'dibatalkan'       ? 'selected' : '' ?>>Dibatalkan</option>
                </select>
            </div>

            <div class="report-filter-actions">
                <button type="button" id="reportResetFilter" class="app-btn app-btn-ghost">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset
                </button>
            </div>

        </form>

    </div>

    <!-- SUMMARY -->
    <div id="reportSummaryContainer">
        <?= view('admin/reports/_summary', ['summary' => $summary]) ?>
    </div>

    <!-- TABLE -->
    <div class="report-content">
        <div id="reportTableContainer">
            <?= view('admin/reports/_table', [
                'items'      => $items,
                'pagination' => $pagination,
                'filters'    => $filters,
                'perPage'    => $perPage,
            ]) ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    window.reportConfig = {
        partialUrl: '<?= site_url('admin/reports/partial') ?>',
        currentFilters: <?= json_encode($filters, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>,
        perPage: <?= (int) $perPage ?>
    };
</script>
<script src="<?= base_url('assets/js/reports.js') ?>"></script>
<?= $this->endSection() ?>