<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Akses Ditolak</title>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Design Tokens -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tokens.css') ?>">

    <!-- Error CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/error.css') ?>">
</head>

<body>

    <?php
    helper('institution');

    $role = session()->get('role');

    $dashboardUrl = match ($role) {
        'administrator' => base_url('admin/dashboard'),
        'petugas' => base_url('petugas/dashboard'),
        default => base_url('akses-panel'),
    };
    ?>

    <main class="error-wrapper">

        <div class="error-card">

            <div class="error-icon">
                <i class="bi bi-shield-lock"></i>
            </div>

            <p class="error-code">403</p>

            <h1 class="error-title">
                Akses Ditolak
            </h1>

            <p class="error-description">
                Anda tidak memiliki izin untuk mengakses halaman ini.
                Silakan kembali ke halaman utama panel Anda.
            </p>

            <a href="<?= esc($dashboardUrl) ?>" class="error-action">
                Kembali ke Dashboard
            </a>

            <p class="error-footer">
                <?= esc(institution_name()) ?>
            </p>

        </div>

    </main>

</body>

</html>