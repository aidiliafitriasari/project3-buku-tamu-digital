<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">

    <title>Terjadi Kesalahan</title>

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
    <link rel="stylesheet" href="/assets/css/tokens.css">

    <!-- Error CSS -->
    <link rel="stylesheet" href="/assets/css/error.css">
</head>

<body>

    <main class="error-wrapper">

        <div class="error-card">

            <div class="error-illustration">
                <img
                    src="<?= base_url('assets/images/errors/500-error.png') ?>"
                    alt="Ilustrasi internal server error 500">
            </div>

            <h1 class="error-title">
                Terjadi Kesalahan
            </h1>

            <p class="error-description">
                Maaf, terjadi kesalahan pada sistem.
                Silakan coba kembali beberapa saat lagi.
            </p>

            <a href="/" class="error-action">
                Kembali ke Beranda
            </a>

            <p class="error-footer">
                Buku Tamu Digital
            </p>

        </div>

    </main>

</body>

</html>