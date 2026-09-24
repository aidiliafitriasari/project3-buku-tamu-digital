<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="dashboard-page">

    <!-- PAGE HEADER -->
    <div class="dashboard-header mb-4">

        <div class="dashboard-header-content">

            <span class="dashboard-eyebrow">
                PANEL ADMINISTRATOR
            </span>

            <h1 class="dashboard-title">
                Dashboard
            </h1>

            <p class="dashboard-description">
                Pantau aktivitas dan pengelolaan sistem secara terpusat.
            </p>

        </div>

    </div>

    <!-- RINGKASAN KUNJUNGAN -->
    <section class="mb-4">

        <div class="mb-3">

            <h5 class="fw-semibold mb-1">
                Ringkasan Kunjungan
            </h5>

            <p class="text-secondary small mb-0">
                Ikhtisar aktivitas kunjungan berdasarkan periode dan status.
            </p>

        </div>

        <div class="row g-3">

            <!-- HARI INI -->
            <div class="col-12 col-sm-6 col-xl">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-day"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Kunjungan Hari Ini
                        </span>

                        <strong>
                            <?= esc($todayVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- MINGGU INI -->
            <div class="col-12 col-sm-6 col-xl">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-week"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Kunjungan Minggu Ini
                        </span>

                        <strong>
                            <?= esc($weekVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- BULAN INI -->
            <div class="col-12 col-sm-6 col-xl">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-month"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Kunjungan Bulan Ini
                        </span>

                        <strong>
                            <?= esc($monthVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- MASIH BERKUNJUNG -->
            <div class="col-12 col-sm-6 col-xl">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-person-walking"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Masih Berkunjung
                        </span>

                        <strong>
                            <?= esc($currentVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- SELESAI -->
            <div class="col-12 col-sm-6 col-xl">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Selesai
                        </span>

                        <strong>
                            <?= esc($completedVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- RINGKASAN MASTER DATA -->
    <section class="mb-4">

        <div class="mb-3">

            <h5 class="fw-semibold mb-1">
                Ringkasan Master Data
            </h5>

            <p class="text-secondary small mb-0">
                Jumlah data master yang tersedia di sistem.
            </p>

        </div>

        <div class="row g-3">

            <!-- PENGGUNA -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-master-card h-100">

                    <div class="dashboard-master-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <div>

                        <span>
                            Total Pengguna
                        </span>

                        <strong>
                            <?= esc($totalUsers ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- PEGAWAI -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-master-card h-100">

                    <div class="dashboard-master-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <div>

                        <span>
                            Total Pegawai
                        </span>

                        <strong>
                            <?= esc($totalEmployees ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- DEPARTEMEN -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-master-card h-100">

                    <div class="dashboard-master-icon">
                        <i class="bi bi-diagram-3"></i>
                    </div>

                    <div>

                        <span>
                            Total Departemen
                        </span>

                        <strong>
                            <?= esc($totalDepartments ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- KEPERLUAN -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-master-card h-100">

                    <div class="dashboard-master-icon">
                        <i class="bi bi-card-checklist"></i>
                    </div>

                    <div>

                        <span>
                            Total Keperluan
                        </span>

                        <strong>
                            <?= esc($totalPurposes ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- STATISTIK KUNJUNGAN -->
    <section class="mb-4">

        <div class="mb-3">

            <h5 class="fw-semibold mb-1">
                Statistik Kunjungan
            </h5>

            <p class="text-secondary small mb-0">
                Visualisasi aktivitas kunjungan berdasarkan data sistem.
            </p>

        </div>

        <div class="row g-3">

            <!-- BERDASARKAN DEPARTEMEN -->
            <div class="col-12 col-xl-4">

                <div class="dashboard-chart-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Berdasarkan Departemen
                            </h6>

                            <span>
                                Distribusi jumlah kunjungan.
                            </span>

                        </div>

                    </div>

                    <div class="dashboard-chart-body">

                        <?php if (! empty($visitsByDepartment)): ?>

                            <div class="dashboard-chart-wrapper">

                                <canvas id="departmentVisitsChart"></canvas>

                            </div>

                        <?php else: ?>

                            <div class="dashboard-empty-state">

                                <div class="dashboard-empty-icon">
                                    <i class="bi bi-bar-chart"></i>
                                </div>

                                <h6>
                                    Belum ada data kunjungan
                                </h6>

                                <p>
                                    Statistik berdasarkan departemen akan muncul setelah terdapat kunjungan.
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <!-- GRAFIK HARIAN -->
            <div class="col-12 col-xl-5">

                <div class="dashboard-chart-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Grafik Harian
                            </h6>

                            <span>
                                Pergerakan kunjungan dari waktu ke waktu.
                            </span>

                        </div>

                    </div>

                    <div class="dashboard-chart-body">

                        <?php if (! empty($dailyVisits)): ?>

                            <div class="dashboard-chart-wrapper">

                                <canvas id="dailyVisitsChart"></canvas>

                            </div>

                        <?php else: ?>

                            <div class="dashboard-empty-state">

                                <div class="dashboard-empty-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>

                                <h6>
                                    Belum ada data kunjungan
                                </h6>

                                <p>
                                    Grafik kunjungan harian akan muncul setelah terdapat kunjungan.
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <!-- JAM TERPADAT -->
            <div class="col-12 col-xl-3">

                <div class="dashboard-chart-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Jam Terpadat
                            </h6>

                            <span>
                                Distribusi berdasarkan jam.
                            </span>

                        </div>

                    </div>

                    <div class="dashboard-chart-body">

                        <?php if (! empty($visitsByHour)): ?>

                            <div class="dashboard-chart-wrapper">

                                <canvas id="visitsByHourChart"></canvas>

                            </div>

                        <?php else: ?>

                            <div class="dashboard-empty-state">

                                <div class="dashboard-empty-icon">
                                    <i class="bi bi-bar-chart-steps"></i>
                                </div>

                                <h6>
                                    Belum ada data kunjungan
                                </h6>

                                <p>
                                    Statistik jam kunjungan akan muncul setelah terdapat kunjungan.
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- MONITORING -->
    <section>

        <div class="mb-3">

            <h5 class="fw-semibold mb-1">
                Monitoring
            </h5>

            <p class="text-secondary small mb-0">
                Pantau kunjungan terbaru dan kunjungan yang membutuhkan perhatian.
            </p>

        </div>

        <div class="row g-3">

            <!-- KUNJUNGAN TERBARU -->
            <div class="col-12 col-xl-8">

                <div class="dashboard-monitor-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Kunjungan Terbaru
                            </h6>

                            <span>
                                Aktivitas kunjungan terbaru dalam sistem.
                            </span>

                        </div>

                        <a
                            href="<?= site_url('admin/visits') ?>"
                            class="dashboard-card-action">
                            Lihat Semua
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>

                    <?php if (! empty($latestVisits)): ?>

                        <div class="dashboard-visit-list">

                            <?php foreach ($latestVisits as $visit): ?>

                                <a
                                    href="<?= site_url('admin/visits/' . $visit['id']) ?>"
                                    class="dashboard-visit-item">

                                    <div class="dashboard-visit-main">

                                        <div class="dashboard-visit-avatar">
                                            <i class="bi bi-person"></i>
                                        </div>

                                        <div class="dashboard-visit-info">

                                            <div class="dashboard-visit-top">

                                                <strong>
                                                    <?= esc($visit['guest_name']) ?>
                                                </strong>

                                                <span class="dashboard-visit-code">
                                                    <?= esc($visit['visit_code']) ?>
                                                </span>

                                            </div>

                                            <div class="dashboard-visit-meta">

                                                <span>

                                                    <i class="bi bi-diagram-3"></i>

                                                    <?= esc($visit['department_name']) ?>

                                                </span>

                                                <span>

                                                    <i class="bi bi-person-badge"></i>

                                                    <?= esc($visit['employee_name']) ?>

                                                </span>

                                            </div>

                                            <div class="dashboard-visit-purpose">

                                                <i class="bi bi-card-checklist"></i>

                                                <?= esc($visit['purpose_name']) ?>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="dashboard-visit-side">

                                        <span class="dashboard-status-badge status-<?= esc($visit['status']) ?>">

                                            <?= esc(
                                                ucwords(
                                                    str_replace('_', ' ', $visit['status'])
                                                )
                                            ) ?>

                                        </span>

                                        <span class="dashboard-visit-time">

                                            <i class="bi bi-clock"></i>

                                            <?= esc(
                                                date(
                                                    'd M Y, H:i',
                                                    strtotime($visit['arrival_at'])
                                                )
                                            ) ?>

                                        </span>

                                    </div>

                                    <div class="dashboard-visit-arrow">

                                        <i class="bi bi-chevron-right"></i>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="dashboard-empty-state">

                            <div class="dashboard-empty-icon">
                                <i class="bi bi-journal-text"></i>
                            </div>

                            <h6>
                                Belum ada data kunjungan
                            </h6>

                            <p>
                                Kunjungan terbaru akan muncul di bagian ini.
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- PERINGATAN -->
            <div class="col-12 col-xl-4">

                <div class="dashboard-monitor-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Peringatan Kunjungan
                            </h6>

                            <span>
                                Kunjungan yang melebihi batas waktu.
                            </span>

                        </div>

                    </div>

                    <?php if (! empty($longVisits)): ?>

                        <div class="dashboard-warning-list">

                            <?php foreach ($longVisits as $visit): ?>

                                <a
                                    href="<?= site_url('admin/visits/' . $visit['id']) ?>"
                                    class="dashboard-warning-item">

                                    <div class="dashboard-warning-icon">

                                        <i class="bi bi-exclamation-triangle"></i>

                                    </div>

                                    <div class="dashboard-warning-content">

                                        <div class="dashboard-warning-top">

                                            <strong>
                                                <?= esc($visit['guest_name']) ?>
                                            </strong>

                                            <span>
                                                <?= esc($visit['visit_code']) ?>
                                            </span>

                                        </div>

                                        <div class="dashboard-warning-meta">

                                            <span>

                                                <i class="bi bi-diagram-3"></i>

                                                <?= esc($visit['department_name']) ?>

                                            </span>

                                            <span>

                                                <i class="bi bi-person-badge"></i>

                                                <?= esc($visit['employee_name']) ?>

                                            </span>

                                        </div>

                                        <div class="dashboard-warning-time">

                                            <i class="bi bi-clock-history"></i>

                                            Check-in

                                            <?= esc(
                                                date(
                                                    'd M Y, H:i',
                                                    strtotime($visit['checkin_at'])
                                                )
                                            ) ?>

                                        </div>

                                    </div>

                                    <div class="dashboard-warning-arrow">

                                        <i class="bi bi-chevron-right"></i>

                                    </div>

                                </a>

                            <?php endforeach; ?>

                        </div>

                    <?php else: ?>

                        <div class="dashboard-empty-state">

                            <div class="dashboard-empty-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <h6>
                                Tidak ada peringatan
                            </h6>

                            <p>
                                Kunjungan yang terlalu lama akan muncul di sini.
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    window.adminDashboardData = <?= json_encode(
                                    [
                                        'visitsByDepartment' => $visitsByDepartment ?? [],
                                        'dailyVisits'        => $dailyVisits ?? [],
                                        'visitsByHour'       => $visitsByHour ?? [],
                                    ],
                                    JSON_HEX_TAG |
                                        JSON_HEX_APOS |
                                        JSON_HEX_AMP |
                                        JSON_HEX_QUOT
                                ) ?>;
</script>

<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>