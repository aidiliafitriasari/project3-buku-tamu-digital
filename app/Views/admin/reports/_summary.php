<div class="report-summary">

    <div class="report-summary-card">
        <div class="report-summary-icon">
            <i class="bi bi-people"></i>
        </div>
        <div class="report-summary-content">
            <span>Total Kunjungan</span>
            <strong><?= esc($summary['total'] ?? 0) ?></strong>
        </div>
    </div>

    <div class="report-summary-card">
        <div class="report-summary-icon report-summary-icon-success">
            <i class="bi bi-check2-circle"></i>
        </div>
        <div class="report-summary-content">
            <span>Selesai</span>
            <strong><?= esc($summary['selesai'] ?? 0) ?></strong>
        </div>
    </div>

    <div class="report-summary-card">
        <div class="report-summary-icon report-summary-icon-info">
            <i class="bi bi-person-walking"></i>
        </div>
        <div class="report-summary-content">
            <span>Masih Berkunjung</span>
            <strong><?= esc($summary['masih_berkunjung'] ?? 0) ?></strong>
        </div>
    </div>

    <div class="report-summary-card">
        <div class="report-summary-icon report-summary-icon-warning">
            <i class="bi bi-x-circle"></i>
        </div>
        <div class="report-summary-content">
            <span>Ditolak</span>
            <strong><?= esc($summary['ditolak'] ?? 0) ?></strong>
        </div>
    </div>

    <div class="report-summary-card">
        <div class="report-summary-icon report-summary-icon-secondary">
            <i class="bi bi-slash-circle"></i>
        </div>
        <div class="report-summary-content">
            <span>Dibatalkan</span>
            <strong><?= esc($summary['dibatalkan'] ?? 0) ?></strong>
        </div>
    </div>

    <div class="report-summary-card">
        <div class="report-summary-icon report-summary-icon-duration">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="report-summary-content">
            <span>Rata-rata Durasi</span>
            <strong>
                <?php
                $avg = (int) ($summary['avg_duration'] ?? 0);
                if ($avg > 0) {
                    $m = floor($avg / 60);
                    $h = floor($m / 60);
                    echo $h > 0 ? $h . 'j ' . ($m % 60) . 'm' : $m . 'm';
                } else {
                    echo '-';
                }
                ?>
            </strong>
        </div>
    </div>

</div>