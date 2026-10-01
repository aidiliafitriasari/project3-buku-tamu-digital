<?php
$success = session()->getFlashdata('success');
$error = session()->getFlashdata('error');
$warning = session()->getFlashdata('warning');
$info = session()->getFlashdata('info');
?>

<div class="toast-container position-fixed top-0 end-0 p-3 app-toast-container">

    <?php if ($success): ?>
        <div
            class="toast app-toast app-toast-success"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-autohide="true"
            data-bs-delay="4000">

            <div class="toast-header">
                <i class="bi bi-check-circle-fill app-toast-icon"></i>
                <strong class="me-auto app-toast-title">Berhasil</strong>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Tutup"></button>
            </div>

            <div class="toast-body">
                <?= esc($success) ?>
            </div>

        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div
            class="toast app-toast app-toast-error"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-autohide="true"
            data-bs-delay="5000">

            <div class="toast-header">
                <i class="bi bi-x-circle-fill app-toast-icon"></i>
                <strong class="me-auto app-toast-title">Gagal</strong>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Tutup"></button>
            </div>

            <div class="toast-body">
                <?= esc($error) ?>
            </div>

        </div>
    <?php endif; ?>

    <?php if ($warning): ?>
        <div
            class="toast app-toast app-toast-warning"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-autohide="true"
            data-bs-delay="4000">

            <div class="toast-header">
                <i class="bi bi-exclamation-triangle-fill app-toast-icon"></i>
                <strong class="me-auto app-toast-title">Peringatan</strong>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Tutup"></button>
            </div>

            <div class="toast-body">
                <?= esc($warning) ?>
            </div>

        </div>
    <?php endif; ?>

    <?php if ($info): ?>
        <div
            class="toast app-toast app-toast-info"
            role="alert"
            aria-live="assertive"
            aria-atomic="true"
            data-bs-autohide="true"
            data-bs-delay="4000">

            <div class="toast-header">
                <i class="bi bi-info-circle-fill app-toast-icon"></i>
                <strong class="me-auto app-toast-title">Informasi</strong>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Tutup"></button>
            </div>

            <div class="toast-body">
                <?= esc($info) ?>
            </div>

        </div>
    <?php endif; ?>

</div>