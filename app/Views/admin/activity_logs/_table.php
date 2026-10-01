<?php if (! empty($items)): ?>

    <div class="master-table-wrapper">

        <table class="master-table">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Aktivitas</th>
                    <th>Module</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($items as $loopIndex => $log): ?>

                    <?php
                    $rowNumber =
                        (($pagination['page'] - 1) * $pagination['perPage'])
                        + $loopIndex
                        + 1;

                    $roleLabel = match ($log['role'] ?? null) {
                        'administrator' => 'Administrator',
                        'petugas' => 'Petugas',
                        default => null,
                    };
                    ?>

                    <tr>

                        <td>
                            <span class="master-table-number">
                                <?= esc($rowNumber) ?>
                            </span>
                        </td>

                        <td>
                            <div class="master-table-primary">
                                <?= esc(date('d M Y', strtotime($log['created_at']))) ?>
                            </div>

                            <div class="master-table-secondary">
                                <?= esc(date('H:i:s', strtotime($log['created_at']))) ?>
                            </div>
                        </td>

                        <td>
                            <?php if (! empty($log['username'])): ?>

                                <div class="master-table-primary">
                                    <?= esc($log['username']) ?>
                                </div>

                                <?php if ($roleLabel): ?>
                                    <div class="master-table-secondary">
                                        <?= esc($roleLabel) ?>
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>

                                <span class="app-badge app-badge-deleted">
                                    System
                                </span>

                            <?php endif; ?>
                        </td>

                        <td>
                            <span class="app-badge app-badge-active">
                                <?= esc($log['activity']) ?>
                            </span>
                        </td>

                        <td>
                            <?= esc($log['module']) ?>
                        </td>

                        <td>
                            <div class="master-table-description">
                                <?= esc($log['description'] ?? '-') ?>
                            </div>
                        </td>

                        <td>
                            <div class="master-table-actions">

                                <button
                                    type="button"
                                    class="app-icon-button"
                                    title="Detail"
                                    aria-label="Detail activity log"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailActivityLogModal"
                                    data-log-id="<?= esc($log['id']) ?>"
                                    data-log-created-at="<?= esc($log['created_at']) ?>"
                                    data-log-username="<?= esc($log['username'] ?? '') ?>"
                                    data-log-role="<?= esc($log['role'] ?? '') ?>"
                                    data-log-activity="<?= esc($log['activity']) ?>"
                                    data-log-module="<?= esc($log['module']) ?>"
                                    data-log-visit-id="<?= esc($log['visit_id'] ?? '') ?>"
                                    data-log-status-history-id="<?= esc($log['visit_status_history_id'] ?? '') ?>"
                                    data-log-description="<?= esc($log['description'] ?? '') ?>">

                                    <i class="bi bi-eye"></i>

                                </button>

                            </div>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <!-- MOBILE LIST -->

    <div class="master-mobile-list">

        <?php foreach ($items as $log): ?>

            <?php
            $roleLabel = match ($log['role'] ?? null) {
                'administrator' => 'Administrator',
                'petugas' => 'Petugas',
                default => null,
            };
            ?>

            <div class="master-mobile-card">

                <div class="master-mobile-card-main">

                    <div class="master-mobile-card-info">

                        <div class="master-table-primary">
                            <?= esc($log['module']) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc(date('d M Y H:i:s', strtotime($log['created_at']))) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($log['username'] ?? 'System') ?>
                            <?= $roleLabel ? ' • ' . esc($roleLabel) : '' ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($log['description'] ?? '-') ?>
                        </div>

                    </div>

                    <span class="app-badge app-badge-active">
                        <?= esc($log['activity']) ?>
                    </span>

                </div>

                <div class="master-mobile-actions">

                    <button
                        type="button"
                        class="app-btn app-btn-primary app-btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#detailActivityLogModal"
                        data-log-id="<?= esc($log['id']) ?>"
                        data-log-created-at="<?= esc($log['created_at']) ?>"
                        data-log-username="<?= esc($log['username'] ?? '') ?>"
                        data-log-role="<?= esc($log['role'] ?? '') ?>"
                        data-log-activity="<?= esc($log['activity']) ?>"
                        data-log-module="<?= esc($log['module']) ?>"
                        data-log-visit-id="<?= esc($log['visit_id'] ?? '') ?>"
                        data-log-status-history-id="<?= esc($log['visit_status_history_id'] ?? '') ?>"
                        data-log-description="<?= esc($log['description'] ?? '') ?>">

                        <i class="bi bi-eye"></i>
                        Detail

                    </button>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->

    <?php if (! empty($pagination)): ?>

        <div class="master-pagination" id="activityLogsPagination">

            <div class="master-pagination-info" id="activityLogsPaginationInfo">

                Menampilkan
                <?= esc($pagination['start']) ?>
                -
                <?= esc($pagination['end']) ?>
                dari
                <?= esc($pagination['total']) ?>
                data

            </div>

            <div class="master-pagination-list" id="activityLogsPaginationList">

                <?php
                $currentPage = (int) $pagination['page'];
                $pageCount = (int) $pagination['pageCount'];

                $startPage = max(1, $currentPage - 2);
                $endPage = min($pageCount, $currentPage + 2);
                ?>

                <!-- PREVIOUS -->
                <button
                    type="button"
                    class="master-pagination-button"
                    data-page="<?= $currentPage - 1 ?>"
                    aria-label="Halaman sebelumnya"
                    <?= $currentPage <= 1 ? 'disabled' : '' ?>>
                    <i class="bi bi-chevron-left"></i>
                </button>

                <!-- FIRST PAGE -->
                <?php if ($startPage > 1): ?>
                    <button type="button" class="master-pagination-button" data-page="1">1</button>
                    <?php if ($startPage > 2): ?>
                        <span class="master-pagination-ellipsis">...</span>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- PAGE NUMBERS -->
                <?php for ($page = $startPage; $page <= $endPage; $page++): ?>
                    <button
                        type="button"
                        class="master-pagination-button <?= $page === $currentPage ? 'is-active' : '' ?>"
                        data-page="<?= $page ?>">
                        <?= $page ?>
                    </button>
                <?php endfor; ?>

                <!-- LAST PAGE -->
                <?php if ($endPage < $pageCount): ?>
                    <?php if ($endPage < $pageCount - 1): ?>
                        <span class="master-pagination-ellipsis">...</span>
                    <?php endif; ?>
                    <button type="button" class="master-pagination-button" data-page="<?= $pageCount ?>">
                        <?= $pageCount ?>
                    </button>
                <?php endif; ?>

                <!-- NEXT -->
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
            <i class="bi bi-clock-history"></i>
        </div>

        <h2 class="app-empty-title">
            Belum ada aktivitas
        </h2>

        <p class="app-empty-text">
            Aktivitas sistem akan muncul di sini.
        </p>

    </div>

<?php endif; ?>