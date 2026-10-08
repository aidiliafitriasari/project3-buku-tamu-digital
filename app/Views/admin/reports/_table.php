<?php if (! empty($items)): ?>

    <div class="report-table-wrapper">

        <table class="report-table">

            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Tamu</th>
                    <th>Asal Instansi</th>
                    <th>Departemen</th>
                    <th>Pegawai</th>
                    <th>Keperluan</th>
                    <th>Datang</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Durasi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($items as $visit): ?>

                    <tr>
                        <td>
                            <span class="report-code"><?= esc($visit['visit_code']) ?></span>
                        </td>

                        <td>
                            <div class="report-guest">
                                <strong><?= esc($visit['guest_name'] ?? '-') ?></strong>
                                <?php if (! empty($visit['phone'])): ?>
                                    <span><?= esc(mask_phone($visit['phone'])) ?></span>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td><?= esc($visit['origin_institution'] ?? '-') ?></td>

                        <td><?= esc($visit['department_name'] ?? '-') ?></td>

                        <td><?= esc($visit['employee_name'] ?? '-') ?></td>

                        <td><?= esc($visit['purpose_name'] ?? '-') ?></td>

                        <td class="report-date">
                            <?= ! empty($visit['arrival_at'])
                                ? esc(date('d/m/Y H:i', strtotime($visit['arrival_at'])))
                                : '-' ?>
                        </td>

                        <td class="report-date">
                            <?= ! empty($visit['checkin_at'])
                                ? esc(date('d/m/Y H:i', strtotime($visit['checkin_at'])))
                                : '-' ?>
                        </td>

                        <td class="report-date">
                            <?= ! empty($visit['checkout_at'])
                                ? esc(date('d/m/Y H:i', strtotime($visit['checkout_at'])))
                                : '-' ?>
                        </td>

                        <td class="report-duration">
                            <?php
                            $duration = $visit['duration'] ?? null;
                            if (! empty($duration)) {
                                $m = floor($duration / 60);
                                $h = floor($m / 60);
                                echo $h > 0 ? $h . 'j ' . ($m % 60) . 'm' : $m . 'm';
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>

                        <td>
                            <span class="report-status report-status-<?= esc($visit['status']) ?>">
                                <?= esc(ucwords(str_replace('_', ' ', $visit['status']))) ?>
                            </span>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <?php if (! empty($pagination) && $pagination['page_count'] > 1): ?>

        <div class="report-pagination">

            <div class="report-pagination-info">
                Menampilkan <strong><?= esc($pagination['from']) ?></strong>–<strong><?= esc($pagination['to']) ?></strong>
                dari <strong><?= esc($pagination['total']) ?></strong> data
            </div>

            <div class="report-pagination-controls">

                <?php if ($pagination['page'] > 1): ?>
                    <a href="#" class="report-page-btn" data-page="<?= esc($pagination['page'] - 1) ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $pagination['page_count']; $i++): ?>
                    <?php if ($i === $pagination['page']): ?>
                        <span class="report-page-btn is-active"><?= esc($i) ?></span>
                    <?php else: ?>
                        <a href="#" class="report-page-btn" data-page="<?= esc($i) ?>"><?= esc($i) ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($pagination['page'] < $pagination['page_count']): ?>
                    <a href="#" class="report-page-btn" data-page="<?= esc($pagination['page'] + 1) ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                <?php endif; ?>

            </div>

        </div>

    <?php endif; ?>

<?php else: ?>

    <div class="app-empty">
        <div class="app-empty-icon">
            <i class="bi bi-journal-text"></i>
        </div>
        <h2 class="app-empty-title">Tidak ada data</h2>
        <p class="app-empty-text">Tidak ada kunjungan sesuai filter yang dipilih.</p>
    </div>

<?php endif; ?>