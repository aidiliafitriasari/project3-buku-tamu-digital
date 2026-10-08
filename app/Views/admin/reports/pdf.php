<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kunjungan — <?= esc($institution['name'] ?? 'Buku Tamu Digital') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/reports/pdf.css') ?>">
</head>

<body>

    <!-- HEADER INSTANSI -->
    <table class="pdf-header-table">
        <tr>

            <?php
            $logoSrc = $logoDataUri ?? (! empty($institution['logo']) ? base_url($institution['logo']) : '');
            ?>

            <?php if (! empty($logoSrc)): ?>
                <td class="pdf-logo-cell">
                    <img src="<?= esc($logoSrc) ?>" alt="Logo">
                </td>
            <?php endif; ?>

            <td class="pdf-header-info">
                <h1><?= esc($institution['name'] ?? 'Buku Tamu Digital') ?></h1>
                <p>
                    <?= esc($institution['address'] ?? '-') ?>
                    <?php if (! empty($institution['phone'])): ?>
                        <br>Telp: <?= esc($institution['phone']) ?>
                    <?php endif; ?>
                    <?php if (! empty($institution['email'])): ?>
                        &nbsp;|&nbsp; Email: <?= esc($institution['email']) ?>
                    <?php endif; ?>
                </p>
            </td>

        </tr>
    </table>

    <!-- JUDUL -->
    <div class="pdf-title">Laporan Kunjungan</div>

    <div class="pdf-period">
        Periode:
        <?php
        $from = $filters['date_from'] ?? '';
        $to   = $filters['date_to'] ?? '';
        if ($from === $to) {
            echo date('d M Y', strtotime($from));
        } else {
            echo date('d M Y', strtotime($from)) . ' — ' . date('d M Y', strtotime($to));
        }
        ?>
    </div>

    <!-- FILTER AKTIF -->
    <div class="pdf-section-title">Filter Aktif</div>

    <table class="pdf-filter-table">
        <tr>
            <td>Departemen</td>
            <td><?= $filters['department_id'] > 0 ? 'ID ' . $filters['department_id'] : 'Semua' ?></td>
        </tr>
        <tr>
            <td>Pegawai</td>
            <td><?= $filters['employee_id'] > 0 ? 'ID ' . $filters['employee_id'] : 'Semua' ?></td>
        </tr>
        <tr>
            <td>Asal Instansi</td>
            <td><?= ! empty($filters['origin_institution']) ? esc($filters['origin_institution']) : 'Semua' ?></td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td><?= $filters['visit_purpose_id'] > 0 ? 'ID ' . $filters['visit_purpose_id'] : 'Semua' ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <?= ! empty($filters['status'])
                    ? esc(ucwords(str_replace('_', ' ', $filters['status'])))
                    : 'Semua' ?>
            </td>
        </tr>
    </table>

    <!-- RINGKASAN -->
    <div class="pdf-section-title">Ringkasan</div>

    <table class="pdf-summary-table">
        <tr>
            <td>Total Kunjungan</td>
            <td><?= esc($summary['total'] ?? 0) ?></td>
        </tr>
        <tr>
            <td>Selesai</td>
            <td><?= esc($summary['selesai'] ?? 0) ?></td>
        </tr>
        <tr>
            <td>Masih Berkunjung</td>
            <td><?= esc($summary['masih_berkunjung'] ?? 0) ?></td>
        </tr>
        <tr>
            <td>Ditolak</td>
            <td><?= esc($summary['ditolak'] ?? 0) ?></td>
        </tr>
        <tr>
            <td>Dibatalkan</td>
            <td><?= esc($summary['dibatalkan'] ?? 0) ?></td>
        </tr>
        <tr>
            <td>Rata-rata Durasi</td>
            <td>
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
            </td>
        </tr>
    </table>

    <!-- TABEL DATA -->
    <?php if (! empty($items)): ?>

        <table class="pdf-data-table">

            <thead>
                <tr>
                    <th class="col-no">No</th>
                    <th class="col-kode">Kode</th>
                    <th class="col-nama">Nama</th>
                    <th class="col-asal">Asal</th>
                    <th class="col-dept">Departemen</th>
                    <th class="col-pegawai">Pegawai</th>
                    <th class="col-keperluan">Keperluan</th>
                    <th class="col-datang">Datang</th>
                    <th class="col-checkin">Check-in</th>
                    <th class="col-checkout">Check-out</th>
                    <th class="col-durasi">Durasi</th>
                    <th class="col-status">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($items as $i => $item): ?>
                    <tr>
                        <td class="col-no"><?= esc($i + 1) ?></td>
                        <td class="col-kode"><?= esc($item['visit_code'] ?? '-') ?></td>
                        <td class="col-nama"><?= esc($item['guest_name'] ?? '-') ?></td>
                        <td class="col-asal"><?= esc($item['origin_institution'] ?? '-') ?></td>
                        <td class="col-dept"><?= esc($item['department_name'] ?? '-') ?></td>
                        <td class="col-pegawai"><?= esc($item['employee_name'] ?? '-') ?></td>
                        <td class="col-keperluan"><?= esc($item['purpose_name'] ?? '-') ?></td>
                        <td class="col-datang"><?= ! empty($item['arrival_at']) ? esc(date('d/m/Y H:i', strtotime($item['arrival_at']))) : '-' ?></td>
                        <td class="col-checkin"><?= ! empty($item['checkin_at']) ? esc(date('d/m/Y H:i', strtotime($item['checkin_at']))) : '-' ?></td>
                        <td class="col-checkout"><?= ! empty($item['checkout_at']) ? esc(date('d/m/Y H:i', strtotime($item['checkout_at']))) : '-' ?></td>
                        <td class="col-durasi">
                            <?php
                            $d = (int) ($item['duration'] ?? 0);
                            if ($d > 0) {
                                $m = floor($d / 60);
                                $h = floor($m / 60);
                                echo $h > 0 ? $h . 'j' . ($m % 60) . 'm' : $m . 'm';
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                        <td class="col-status">
                            <span class="pdf-status pdf-status-<?= esc($item['status'] ?? '') ?>">
                                <?= esc(ucwords(str_replace('_', ' ', $item['status'] ?? '-'))) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    <?php else: ?>

        <div class="pdf-empty">
            Tidak ada data kunjungan sesuai filter yang dipilih.
        </div>

    <?php endif; ?>

    <!-- TANDA TANGAN -->
    <table class="pdf-signature">
        <tr>
            <td>
                <div class="pdf-signature-label">
                    Petugas,
                </div>
                <div class="pdf-signature-line">
                    (........................................)
                </div>
            </td>

            <td>
                <div class="pdf-signature-label">
                    <?= esc($institution['name'] ?? 'Instansi') ?>,
                    <?= date('d M Y') ?>
                    <br><br>
                    Kepala,
                </div>
                <div class="pdf-signature-line">
                    (........................................)
                </div>
            </td>
        </tr>
    </table>

</body>

</html>