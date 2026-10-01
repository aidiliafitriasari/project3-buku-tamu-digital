<?= $this->extend('layouts/panel') ?>

<?= $this->section('styles') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/master.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/master/activity_logs.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="master-page">

    <div class="master-header">

        <div class="master-header-info">

            <h1 class="master-title">
                Activity Log
            </h1>

            <p class="master-description">
                Riwayat aktivitas yang tercatat di dalam sistem.
            </p>

        </div>

    </div>

    <form
        action="<?= base_url('admin/activity-logs') ?>"
        method="get"
        class="master-toolbar"
        id="activityLogsFilterForm">

        <div class="master-search">

            <i class="bi bi-search master-search-icon"></i>

            <input
                type="search"
                name="search"
                value=""
                class="master-search-input"
                placeholder="Cari user, aktivitas, module, atau deskripsi..."
                autocomplete="off"
                id="activityLogsSearchInput">

        </div>

        <div class="master-filters">

            <select
                name="activity"
                class="master-filter"
                id="activityLogsActivityFilter">

                <option value="">
                    Semua Aktivitas
                </option>

                <option value="create">
                    Create
                </option>

                <option value="update">
                    Update
                </option>

                <option value="delete">
                    Delete
                </option>

                <option value="restore">
                    Restore
                </option>

                <option value="activate">
                    Activate
                </option>

                <option value="deactivate">
                    Deactivate
                </option>

                <option value="reset_password">
                    Reset Password
                </option>

                <option value="login">
                    Login
                </option>

                <option value="logout">
                    Logout
                </option>

            </select>

            <select
                name="per_page"
                class="master-filter"
                id="activityLogsPerPageFilter">

                <?php foreach ([50, 100, 250, 500] as $option): ?>

                    <option value="<?= $option ?>">
                        <?= $option ?> data
                    </option>

                <?php endforeach; ?>

            </select>

            <button
                type="button"
                class="app-btn app-btn-ghost app-btn-sm"
                id="activityLogsResetFilter">

                <i class="bi bi-arrow-counterclockwise"></i>

                Reset

            </button>

        </div>

    </form>

    <div class="master-content-wrapper">

        <div
            class="master-loading-overlay"
            id="activityLogsLoading"
            hidden>
            <div class="app-loading">
                <div class="app-loading-spinner"></div>
                <span>Memuat data...</span>
            </div>
        </div>

        <div class="master-content" id="activityLogsContent">

            <?= view('admin/activity_logs/_table', [
                'items' => $items ?? [],
                'pagination' => $pagination ?? null,
            ]) ?>

        </div>

    </div>

</div>

<?= view('admin/activity_logs/detail') ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/activity_logs.js') ?>"></script>

<?= $this->endSection() ?>