<?php

$flashTypes = [
    'success' => [
        'class' => 'alert-success',
        'icon'  => 'bi-check-circle-fill',
    ],
    'error' => [
        'class' => 'alert-danger',
        'icon'  => 'bi-exclamation-circle-fill',
    ],
    'warning' => [
        'class' => 'alert-warning',
        'icon'  => 'bi-exclamation-triangle-fill',
    ],
    'info' => [
        'class' => 'alert-info',
        'icon'  => 'bi-info-circle-fill',
    ],
];

foreach ($flashTypes as $type => $config):

    $message = session()->getFlashdata($type);

    if ($message):
?>

        <div
            class="alert <?= esc($config['class']) ?> panel-alert alert-dismissible fade show"
            role="alert">

            <div class="d-flex align-items-start gap-2">

                <i class="bi <?= esc($config['icon']) ?> mt-1"></i>

                <div class="flex-grow-1">
                    <?= esc($message) ?>
                </div>

            </div>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup"></button>

        </div>

<?php
    endif;

endforeach;
?>