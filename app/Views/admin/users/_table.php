<?php if (! empty($items)): ?>

    <div class="master-table-wrapper">

        <table class="master-table">

            <thead>

                <tr>

                    <th>
                        No
                    </th>

                    <th>
                        Pengguna
                    </th>

                    <th>
                        Role
                    </th>

                    <th>
                        Nomor HP
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($items as $loopIndex => $user): ?>

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

                                <?= esc($user['username']) ?>

                            </div>

                            <div class="master-table-secondary">

                                <?= esc($user['email']) ?>

                            </div>

                        </td>

                        <td>

                            <?= view('admin/users/_role_label', ['user' => $user]) ?>

                        </td>

                        <td>

                            <?= esc($user['nomor_hp']) ?>

                        </td>

                        <td>

                            <?= view('admin/users/_status_badge', ['user' => $user]) ?>

                        </td>

                        <td>

                            <?= view('admin/users/_actions', [
                                'user' => $user,
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

        <?php foreach ($items as $loopIndex => $user): ?>

            <div class="master-mobile-card">

                <div class="master-mobile-card-main">

                    <div class="master-mobile-card-info">

                        <div class="master-table-primary">
                            <?= esc($user['username']) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($user['email']) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= view('admin/users/_role_label', ['user' => $user]) ?>
                        </div>

                        <div class="master-table-secondary">
                            <?= esc($user['nomor_hp']) ?>
                        </div>

                    </div>

                    <?= view('admin/users/_status_badge', ['user' => $user]) ?>

                </div>

                <?= view('admin/users/_actions', [
                    'user' => $user,
                    'containerClass' => 'master-mobile-actions',
                ]) ?>

            </div>

        <?php endforeach; ?>

    </div>

    <!-- PAGINATION -->
    <?php if (! empty($pagination)): ?>

        <div
            class="master-pagination"
            id="usersPagination">

            <!-- PAGINATION INFO -->
            <div
                class="master-pagination-info"
                id="usersPaginationInfo">

                Menampilkan
                <?= esc($pagination['start']) ?>
                -
                <?= esc($pagination['end']) ?>
                dari
                <?= esc($pagination['total']) ?>
                data

            </div>

            <!-- PAGINATION BUTTONS -->
            <div
                class="master-pagination-list"
                id="usersPaginationList">

                <?php
                $currentPage = (int) $pagination['page'];
                $pageCount = (int) $pagination['pageCount'];

                $startPage = max(1, $currentPage - 2);
                $endPage = min($pageCount, $currentPage + 2);
                ?>

                <!-- PREVIOUS (selalu tampil) -->
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
                    <button type="button" class="master-pagination-button <?= $page === $currentPage ? 'is-active' : '' ?>" data-page="<?= $page ?>">
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

            <i class="bi bi-people"></i>

        </div>

        <h2 class="app-empty-title">
            Tidak ada pengguna
        </h2>

        <p class="app-empty-text">
            Belum ada data pengguna yang sesuai dengan pencarian atau filter.
        </p>

    </div>

<?php endif; ?>