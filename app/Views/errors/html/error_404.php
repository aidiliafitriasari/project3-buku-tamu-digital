<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Halaman Tidak Ditemukan</title>

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

    $redirectUrl = match ($role) {
        'administrator' => base_url('admin/dashboard'),
        'petugas' => base_url('petugas/dashboard'),
        default => base_url('akses-panel'),
    };

    $redirectLabel = $role
        ? 'Kembali ke Dashboard'
        : 'Kembali ke Halaman Login';
    ?>

    <main class="error-wrapper">

        <div class="error-card">

            <div class="error-icon">
                <i class="bi bi-compass"></i>
            </div>

            <p class="error-code">404</p>

            <h1 class="error-title">
                Halaman Tidak Ditemukan
            </h1>

            <p class="error-description">
                Halaman yang kamu cari tidak tersedia
                atau alamat yang dimasukkan tidak benar.
            </p>

            <a href="<?= esc($redirectUrl) ?>" class="error-action">
                <?= esc($redirectLabel) ?>
            </a>

            <p class="error-footer">
                <?= esc(institution_name()) ?>
            </p>

        </div>

    </main>

</body>

</html>