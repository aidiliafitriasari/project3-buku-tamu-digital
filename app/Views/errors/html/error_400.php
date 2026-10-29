<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">

    <title><?= lang('Errors.badRequest') ?></title>


    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Error Page Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tokens.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/error.css') ?>">
</head>

<body>
    <main class="error-wrapper">
        <section class="error-card">

            <!-- Illustration -->
            <div class="error-illustration">
                <img
                    src="<?= base_url('assets/images/errors/400-bad-request.png') ?>"
                    alt="Ilustrasi bad request 400">
            </div>

            <!-- Title -->
            <h1 class="error-title">
                Permintaan Tidak Valid
            </h1>

            <!-- Error Message -->
            <p class="error-description">
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <?= nl2br(esc($message)) ?>
                <?php else : ?>
                    <?= lang('Errors.sorryBadRequest') ?>
                <?php endif; ?>
            </p>

        </section>
    </main>
</body>

</html>