<?= $this->extend('layouts/auth') ?>

<?php helper('institution'); ?>

<?= $this->section('content') ?>

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
        autocomplete="on"
        id="loginForm"
        novalidate>

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

            <div
                class="field-error"
                id="credentialError"
                aria-live="polite"></div>

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

            <div
                class="field-error"
                id="passwordError"
                aria-live="polite"></div>

        </div>

        <!-- Login -->
        <button
            type="submit"
            class="login-button"
            id="loginButton">

            <i class="bi bi-box-arrow-in-right me-2"></i>

            <span>Masuk ke Dashboard</span>

        </button>

    </form>

    <!-- Footer -->
    <div class="text-center mt-4">

        <div class="footer-text">
            <?= esc(institution_name()) ?>
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= base_url('assets/js/login.js') ?>"></script>

<?= $this->endSection() ?>