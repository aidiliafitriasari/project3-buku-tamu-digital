<?php helper('institution'); ?>

<header class="guest-header">

    <div class="guest-header-inner">

        <div class="guest-header-brand">

            <?php if (institution_logo()): ?>
                <img
                    src="<?= base_url(institution_logo()) ?>"
                    alt="Logo <?= esc(institution_name()) ?>"
                    class="guest-header-logo">
            <?php else: ?>
                <div class="guest-header-logo-placeholder">
                    <i class="bi bi-building"></i>
                </div>
            <?php endif; ?>

            <div class="guest-header-info">

                <h1 class="guest-header-title">
                    <?= esc(institution_name()) ?>
                </h1>

                <?php if (institution_address()): ?>
                    <p class="guest-header-subtitle">
                        <?= esc(institution_address()) ?>
                    </p>
                <?php endif; ?>

            </div>

        </div>

    </div>

</header>