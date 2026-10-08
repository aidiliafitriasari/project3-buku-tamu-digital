<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/petugas-dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="dashboard-page">

    <!-- DASHBOARD HEADER -->
    <div class="dashboard-header mb-4">

        <div class="dashboard-header-content">

            <span class="dashboard-eyebrow">
                PANEL PETUGAS
            </span>

            <h1 class="dashboard-title">
                Dashboard
            </h1>

            <p class="dashboard-description">
                Pantau dan proses kunjungan tamu secara langsung.
            </p>

        </div>

    </div>

    <!-- RINGKASAN KUNJUNGAN -->
    <section class="mb-4">

        <div class="row g-3">

            <!-- Total Kunjungan Hari Ini -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-day"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Total Kunjungan Hari Ini
                        </span>

                        <strong>
                            <?= esc($todayVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- Menunggu -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Menunggu
                        </span>

                        <strong>
                            <?= esc($waitingVisits ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

            <!-- Masih Berkunjung -->
            <div class="col-12 col-sm-6 col-xl-3">

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

            <!-- Selesai Hari Ini -->
            <div class="col-12 col-sm-6 col-xl-3">

                <div class="dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span>
                            Selesai Hari Ini
                        </span>

                        <strong>
                            <?= esc($completedToday ?? 0) ?>
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- STATISTIK OPERASIONAL -->
    <section class="mb-4">

        <div class="row g-3">

            <!-- Grafik Kunjungan Hari Ini -->
            <div class="col-12 col-xl-8">

                <div class="dashboard-chart-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Grafik Kunjungan Hari Ini
                            </h6>

                            <span>
                                Grafik kunjungan berdasarkan jam.
                            </span>

                        </div>

                    </div>

                    <div class="dashboard-chart-body">

                        <div class="dashboard-chart-wrapper">

                            <canvas id="todayVisitsChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Ringkasan Status -->
            <div class="col-12 col-xl-4">

                <div class="dashboard-monitor-card h-100">

                    <div class="dashboard-card-header">

                        <div>

                            <h6 class="fw-semibold mb-1">
                                Ringkasan Status
                            </h6>

                            <span>
                                Ringkasan seluruh status kunjungan.
                            </span>

                        </div>

                    </div>

                    <div class="p-3">

                        <?php if (! empty($statusSummary)): ?>

                            <div class="d-flex flex-column gap-2">

                                <?php foreach ($statusSummary as $status => $total): ?>

                                    <?php
                                    $statusClass = match ($status) {
                                        'menunggu'          => 'dashboard-status-warning',
                                        'ditolak'           => 'dashboard-status-danger',
                                        'dibatalkan'        => 'dashboard-status-secondary',
                                        'masih_berkunjung' => 'dashboard-status-info',
                                        'selesai'           => 'dashboard-status-success',
                                        default             => 'dashboard-status-secondary',
                                    };
                                    ?>

                                    <div class="d-flex align-items-center justify-content-between gap-3">

                                        <span class="dashboard-status-badge <?= esc($statusClass) ?>">

                                            <?= esc(
                                                ucwords(
                                                    str_replace('_', ' ', $status)
                                                )
                                            ) ?>

                                        </span>

                                        <strong>
                                            <?= esc($total) ?>
                                        </strong>

                                    </div>

                                <?php endforeach; ?>

                            </div>

                        <?php else: ?>

                            <div class="dashboard-empty-state">

                                <div class="dashboard-empty-icon">
                                    <i class="bi bi-bar-chart"></i>
                                </div>

                                <h6>
                                    Belum ada data
                                </h6>

                                <p>
                                    Belum ada statistik status kunjungan.
                                </p>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- KUNJUNGAN MENUNGGU -->
    <section class="mb-4">

        <div class="dashboard-monitor-card">

            <div class="dashboard-card-header">

                <div>

                    <h6 class="fw-semibold mb-1">
                        Kunjungan Menunggu
                    </h6>

                    <span>
                        Kunjungan yang menunggu proses verifikasi.
                    </span>

                </div>

                <span class="text-muted small">

                    <?= count($waitingVisitList ?? []) ?>

                    data

                </span>

            </div>

            <?php if (! empty($waitingVisitList)): ?>

                <div class="dashboard-visit-list">

                    <?php foreach ($waitingVisitList as $visit): ?>

                        <a
                            href="<?= site_url('petugas/visits/' . $visit['id']) ?>"

                            class="dashboard-visit-item">

                            <div class="dashboard-visit-main">

                                <div class="dashboard-visit-avatar">
                                    <i class="bi bi-person"></i>
                                </div>

                                <div class="dashboard-visit-info">

                                    <div class="dashboard-visit-top">
                                        <strong><?= esc($visit['guest_name'] ?? '-') ?></strong>

                                        <span class="dashboard-visit-code"><?= esc($visit['visit_code'] ?? '-') ?></span>
                                    </div>

                                    <div class="dashboard-visit-meta">
                                        <span>
                                            <i class="bi bi-diagram-3"></i>
                                            <?= esc($visit['department_name'] ?? '-') ?>
                                        </span>
                                        <span>
                                            <i class="bi bi-person-badge"></i>
                                            <?= esc($visit['employee_name'] ?? '-') ?>
                                        </span>
                                    </div>

                                    <div class="dashboard-visit-purpose">
                                        <i class="bi bi-card-checklist"></i>
                                        <?= esc($visit['purpose_name'] ?? '-') ?>
                                    </div>

                                </div>

                            </div>

                            <div class="dashboard-visit-side">

                                <span class="dashboard-status-badge status-<?= esc($visit['status'] ?? 'menunggu') ?>">
                                    <?= esc(ucwords(str_replace('_', ' ', $visit['status'] ?? 'menunggu'))) ?>
                                </span>

                                <span class="dashboard-visit-time">
                                    <i class="bi bi-clock"></i>

                                    <?= ! empty($visit['arrival_at'])
                                        ? esc(
                                            date(
                                                'd/m/Y H:i',
                                                strtotime($visit['arrival_at'])
                                            )
                                        )
                                        : '-' ?>

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
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <h6>
                        Tidak ada kunjungan menunggu
                    </h6>

                    <p>
                        Belum ada kunjungan yang menunggu proses verifikasi.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <!-- TAMU MASIH BERKUNJUNG -->
    <section class="mb-4">

        <div class="dashboard-monitor-card">

            <div class="dashboard-card-header">

                <div>

                    <h6 class="fw-semibold mb-1">
                        Tamu Masih Berkunjung
                    </h6>

                    <span>
                        Tamu yang sedang berada di lokasi.
                    </span>

                </div>

                <span class="text-muted small">

                    <?= count($currentVisitList ?? []) ?>

                    data

                </span>

            </div>

            <?php if (! empty($currentVisitList)): ?>

                <div class="dashboard-visit-list">

                    <?php foreach ($currentVisitList as $visit): ?>

                        <a
                            href="<?= site_url('petugas/visits/' . $visit['id']) ?>"
                            class="dashboard-visit-item">

                            <div class="dashboard-visit-main">

                                <div class="dashboard-visit-avatar">
                                    <i class="bi bi-person-walking"></i>
                                </div>

                                <div class="dashboard-visit-info">
                                    <div class="dashboard-visit-top">
                                        <strong><?= esc($visit['guest_name'] ?? '-') ?></strong>

                                        <span class="dashboard-visit-code"><?= esc($visit['visit_code'] ?? '-') ?></span>
                                    </div>

                                    <div class="dashboard-visit-meta">

                                        <span>
                                            <i class="bi bi-diagram-3"></i>
                                            <?= esc($visit['department_name'] ?? '-') ?>
                                        </span>

                                        <span>
                                            <i class="bi bi-person-badge"></i>
                                            <?= esc($visit['employee_name'] ?? '-') ?>
                                        </span>

                                    </div>

                                    <div class="dashboard-visit-purpose">
                                        <i class="bi bi-card-checklist"></i>
                                        <?= esc($visit['purpose_name'] ?? '-') ?>
                                    </div>

                                </div>

                            </div>

                            <div class="dashboard-visit-side">

                                <span class="dashboard-status-badge status-<?= esc($visit['status'] ?? 'masih_berkunjung') ?>">
                                    <?= esc(ucwords(str_replace('_', ' ', $visit['status'] ?? 'masih_berkunjung'))) ?>
                                </span>

                                <span class="dashboard-visit-time">
                                    <i class="bi bi-clock"></i>
                                    <?= ! empty($visit['checkin_at'])
                                        ? esc(
                                            date(
                                                'd/m/Y H:i',
                                                strtotime($visit['checkin_at'])
                                            )
                                        )
                                        : '-' ?>

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
                        <i class="bi bi-person-walking"></i>
                    </div>

                    <h6>
                        Tidak ada tamu berkunjung
                    </h6>

                    <p>
                        Saat ini tidak ada tamu yang sedang berkunjung.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

    <!-- PERINGATAN KUNJUNGAN TERLALU LAMA -->
    <section class="mb-4">

        <div class="dashboard-monitor-card">

            <div class="dashboard-card-header">

                <div>

                    <h6 class="fw-semibold mb-1">
                        Peringatan Kunjungan Terlalu Lama
                    </h6>

                    <span>
                        Kunjungan yang melebihi batas waktu
                        <?php if (! empty($visitWarning)): ?>
                            <strong>(Batas: <?= esc($visitWarning) ?> menit)</strong>
                            <?php endif; ?>.
                    </span>

                </div>

                <span class="text-muted small">

                    <?= count($longVisits ?? []) ?>

                    data

                </span>

            </div>

            <?php if (! empty($longVisits)): ?>

                <div class="dashboard-warning-list">

                    <?php foreach ($longVisits as $visit): ?>

                        <a
                            href="<?= site_url('petugas/visits/' . $visit['id']) ?>"
                            class="dashboard-warning-item">

                            <div class="dashboard-warning-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>

                            <div class="dashboard-warning-content">

                                <div class="dashboard-warning-top">
                                    <strong><?= esc($visit['guest_name'] ?? '-') ?></strong>
                                    <span><?= esc($visit['visit_code'] ?? '-') ?></span>
                                </div>

                                <div class="dashboard-warning-meta">

                                    <span>
                                        <i class="bi bi-diagram-3"></i>
                                        <?= esc($visit['department_name'] ?? '-') ?>
                                    </span>

                                    <span>
                                        <i class="bi bi-person-badge"></i>
                                        <?= esc($visit['employee_name'] ?? '-') ?>
                                    </span>

                                </div>

                                <div class="dashboard-warning-time">
                                    <i class="bi bi-clock-history"></i>
                                    Check-in
                                    <?= ! empty($visit['checkin_at'])
                                        ? esc(
                                            date(
                                                'd/m/Y H:i',
                                                strtotime($visit['checkin_at'])
                                            )
                                        )
                                        : '-' ?>

                                </div>

                                <?php if (! empty($visit['duration_minutes'])): ?>
                                    <div class="dashboard-warning-time">
                                        <i class="bi bi-hourglass-split"></i>
                                        Durasi: <strong><?= esc($visit['duration_minutes']) ?> menit</strong>
                                    </div>
                                <?php endif; ?>

                            </div>

                        </a>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="dashboard-empty-state">

                    <div class="dashboard-empty-icon">
                        <i class="bi bi-check2-circle"></i>
                    </div>

                    <h6>
                        Tidak ada peringatan
                    </h6>

                    <p>
                        Tidak ada kunjungan yang melebihi batas waktu.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    window.petugasDashboardData = {
        todayVisitsByHour: <?= json_encode(
                                $todayVisitsByHour ?? [],
                                JSON_HEX_TAG |
                                    JSON_HEX_APOS |
                                    JSON_HEX_AMP |
                                    JSON_HEX_QUOT
                            ) ?>
    };
</script>

<script src="<?= base_url('assets/js/petugas-dashboard.js') ?>"></script>

<?= $this->endSection() ?>