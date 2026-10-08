<?php
$isAdmin = $isAdmin ?? false;
?>

<?php if (! empty($items)): ?>

    <div class="master-table-wrapper">

        <table class="master-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tamu</th>
                    <th>Tujuan</th>
                    <th>Keperluan</th>
                    <th>Waktu Datang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($items as $loopIndex => $visit): ?>

                    <?php
                    $rowNumber = (($pagination['page'] - 1) * $pagination['perPage']) + $loopIndex + 1;
                    ?>

                    <tr>

                        <td>
                            <span class="master-table-number">
                                <?= esc($rowNumber) ?>
                            </span>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc($visit['visit_code']) ?>
                            </div>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc($visit['guest_name'] ?? '-') ?>
                            </div>
                            <div class="master-table-secondary">
                                <?= esc(mask_phone($visit['phone'] ?? null)) ?>
                            </div>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc($visit['department_name'] ?? '-') ?>
                            </div>
                            <div class="master-table-secondary">
                                <?= esc($visit['employee_name'] ?? '-') ?>
                            </div>
                        </td>

                        <td>
                            <?= esc($visit['purpose_name'] ?? '-') ?>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc(date('d M Y', strtotime($visit['arrival_at']))) ?>
                            </div>
                            <div class="master-table-secondary">
                                <?= esc(date('H:i', strtotime($visit['arrival_at']))) ?>
                            </div>
                        </td>

                        <td>
                            <?= view('petugas/visits/_status_badge', ['visit' => $visit]) ?>
                        </td>

                        <td>
                            <?= view('petugas/visits/_actions', [
                                'visit'        => $visit,
                                'isAdmin'      => $isAdmin,
                                'statusFilter' => $status ?? null,
                            ]) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <div class="master-mobile-list">

        <?php foreach ($items as $loopIndex => $visit): ?>

            <div class="master-mobile-card">

                <div class="master-mobile-card-main">

                    <div class="master-mobile-card-info">

                        <div class="master-table-primary">
                            <?= esc($visit['guest_name'] ?? '-') ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($visit['visit_code']) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc(mask_phone($visit['phone'] ?? null)) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($visit['department_name'] ?? '-') ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($visit['purpose_name'] ?? '-') ?>
                        </div>

                    </div>

                    <?= view('petugas/visits/_status_badge', ['visit' => $visit]) ?>

                </div>

                <?= view('petugas/visits/_actions', [
                    'visit'        => $visit,
                    'isAdmin'      => $isAdmin,
                    'statusFilter' => $status ?? null,
                ]) ?>

            </div>

        <?php endforeach; ?>

    </div>

    <?php if (! empty($pagination)): ?>

        <div
            class="master-pagination"
            id="visitsPagination">

            <div
                class="master-pagination-info"
                id="visitsPaginationInfo">

                Menampilkan
                <?= esc($pagination['start']) ?>
                -
                <?= esc($pagination['end']) ?>
                dari
                <?= esc($pagination['total']) ?>
                data

            </div>

            <div
                class="master-pagination-list"
                id="visitsPaginationList">

                <?php
                $currentPage = (int) $pagination['page'];
                $pageCount = (int) $pagination['pageCount'];

                $startPage = max(1, $currentPage - 2);
                $endPage = min($pageCount, $currentPage + 2);
                ?>

                <button
                    type="button"
                    class="master-pagination-button"
                    data-page="<?= $currentPage - 1 ?>"
                    aria-label="Halaman sebelumnya"
                    <?= $currentPage <= 1 ? 'disabled' : '' ?>>
                    <i class="bi bi-chevron-left"></i>
                </button>

                <?php if ($startPage > 1): ?>
                    <button type="button" class="master-pagination-button" data-page="1">1</button>
                    <?php if ($startPage > 2): ?>
                        <span class="master-pagination-ellipsis">...</span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                    <button type="button" class="master-pagination-button <?= $page === $currentPage ? 'is-active' : '' ?>" data-page="<?= $page ?>">
                        <?= $page ?>
                    </button>
                <?php endfor; ?>

                <?php if ($endPage < $pageCount): ?>
                    <?php if ($endPage < $pageCount - 1): ?>
                        <span class="master-pagination-ellipsis">...</span>
                    <?php endif; ?>
                    <button type="button" class="master-pagination-button" data-page="<?= $pageCount ?>">
                        <?= $pageCount ?>
                    </button>
                <?php endif; ?>

                <button
                    type="button"
                    class="master-pagination-button"
                    data-page="<?= $currentPage + 1 ?>"
                    aria-label="Halaman berikutnya"
                    <?= $currentPage >= $pageCount ? 'disabled' : '' ?>>
                    <i class="bi bi-chevron-right"></i>
                </button>

            </div>

        </div>

    <?php endif; ?>

<?php else: ?>

    <div class="app-empty">

        <div class="app-empty-icon">
            <i class="bi bi-journal-x"></i>
        </div>

        <h2 class="app-empty-title">
            Tidak ada kunjungan
        </h2>

        <p class="app-empty-text">
            Belum ada data kunjungan yang sesuai dengan filter.
        </p>

    </div>

<?php endif; ?>