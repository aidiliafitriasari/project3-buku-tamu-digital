<?php if (! empty($items)): ?>

    <div class="master-table-wrapper">

        <table class="master-table">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama Keperluan</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($items as $loopIndex => $purpose): ?>

                    <?php
                    $rowNumber =
                        (($pagination['page'] - 1) * $pagination['perPage'])
                        + $loopIndex
                        + 1;
                    ?>

                    <tr>

                        <td>
                            <span class="master-table-number">
                                <?= esc($rowNumber) ?>
                            </span>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc($purpose['name']) ?>
                            </div>
                        </td>

                        <td>
                            <?= view('admin/visit_purposes/_status_badge', ['purpose' => $purpose]) ?>
                        </td>

                        <td>
                            <?= view('admin/visit_purposes/_actions', [
                                'purpose' => $purpose,
                                'containerClass' => 'master-table-actions',
                            ]) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <!-- MOBILE LIST -->
    <div class="master-mobile-list">

        <?php foreach ($items as $purpose): ?>

            <div class="master-mobile-card">

                <div class="master-mobile-card-main">

                    <div class="master-mobile-card-info">

                        <div class="master-table-primary">
                            <?= esc($purpose['name']) ?>
                        </div>

                    </div>

                    <?= view('admin/visit_purposes/_status_badge', ['purpose' => $purpose]) ?>

                </div>

                <?= view('admin/visit_purposes/_actions', [
                    'purpose' => $purpose,
                    'containerClass' => 'master-mobile-actions',
                ]) ?>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->
    <?php if (! empty($pagination)): ?>

        <div class="master-pagination" id="visitPurposesPagination">

            <div class="master-pagination-info" id="visitPurposesPaginationInfo">

                Menampilkan
                <?= esc($pagination['start']) ?>
                -
                <?= esc($pagination['end']) ?>
                dari
                <?= esc($pagination['total']) ?>
                data

            </div>

            <div class="master-pagination-list" id="visitPurposesPaginationList">

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
                    <button
                        type="button"
                        class="master-pagination-button <?= $page === $currentPage ? 'is-active' : '' ?>"
                        data-page="<?= $page ?>">
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
            <i class="bi bi-list-check"></i>
        </div>

        <h2 class="app-empty-title">
            Tidak ada keperluan
        </h2>

        <p class="app-empty-text">
            Belum ada data keperluan yang sesuai dengan pencarian atau filter.
        </p>

    </div>

<?php endif; ?>