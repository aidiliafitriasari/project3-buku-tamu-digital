<?php helper('institution'); ?>

<footer class="guest-footer">

    <div class="guest-footer-inner">

        <div class="guest-footer-contact">

            <?php if (institution_phone()): ?>
                <p class="guest-footer-item">
                    <i class="bi bi-telephone"></i>
                    <span><?= esc(institution_phone()) ?></span>
                </p>
            <?php endif; ?>

            <?php if (institution_email()): ?>
                <p class="guest-footer-item">
                    <i class="bi bi-envelope"></i>
                    <span><?= esc(institution_email()) ?></span>
                </p>
            <?php endif; ?>

        </div>

        <div class="guest-footer-copyright">
            <p>
                &copy; <?= date('Y') ?>
                Buku Tamu Digital
            </p>
        </div>

    </div>

</footer>