<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Buku Tamu Digital</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Login CSS -->
    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/login.css') ?>">

</head>

<body>

    <main class="login-wrapper">

        <div class="glass-card">

            <!-- Brand -->
            <div class="text-center">

                <div class="brand-icon">
                    <i class="bi bi-person-lock"></i>
                </div>

                <h1 class="login-title fs-4 mb-2">
                    Selamat Datang
                </h1>

                <p class="login-subtitle mb-4">
                    Masuk ke Dashboard Buku Tamu Digital
                </p>

            </div>

            <!-- Error -->
            <?php if (session()->getFlashdata('error')): ?>

                <div
                    class="alert alert-danger d-flex align-items-center gap-2 mb-4"
                    role="alert">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <span>
                        <?= esc(session()->getFlashdata('error')) ?>
                    </span>

                </div>

            <?php endif; ?>

            <!-- Success -->
            <?php if (session()->getFlashdata('success')): ?>

                <div
                    class="alert alert-success d-flex align-items-center gap-2 mb-4"
                    role="alert">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        <?= esc(session()->getFlashdata('success')) ?>
                    </span>

                </div>

            <?php endif; ?>

            <!-- Login Form -->
            <form
                action="<?= base_url('akses-panel') ?>"
                method="post"
                autocomplete="on">

                <?= csrf_field() ?>

                <!-- Credential -->
                <div class="mb-3">

                    <label
                        for="credential"
                        class="form-label">

                        Username atau Email
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input
                            type="text"
                            class="form-control"
                            id="credential"
                            name="credential"
                            value="<?= old('credential') ?>"
                            placeholder="Masukkan username atau email"
                            autocomplete="username"
                            required>

                    </div>

                </div>

                <!-- Password -->
                <div class="mb-4">

                    <label
                        for="password"
                        class="form-label">

                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>

                        <button
                            type="button"
                            class="btn border-0 text-secondary"
                            id="togglePassword"
                            aria-label="Tampilkan password">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>

                <!-- Login -->
                <button
                    type="submit"
                    class="login-button">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Masuk ke Dashboard

                </button>

            </form>

            <!-- Footer -->
            <div class="text-center mt-4">

                <div class="footer-text">
                    Buku Tamu Digital
                </div>

                <div class="footer-text mt-1">
                    CV Amins Project Teknologi Indonesia
                </div>

            </div>

        </div>

    </main>

    <script src="<?= base_url('assets/js/login.js') ?>"></script>

</body>

</html>