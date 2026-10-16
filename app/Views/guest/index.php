<?= $this->extend('layouts/guest') ?>

<?= $this->section('content') ?>

<!-- CARD: Selamat Datang -->
<div class="guest-card guest-welcome-card">

    <div class="guest-card-header-center">
        <h2 class="guest-card-title-center">
            Buku Tamu Digital
        </h2>

        <p class="guest-card-description-center">
            Selamat datang. Silakan lakukan registrasi kunjungan
            sebelum masuk ke area instansi.
        </p>
    </div>

    <div class="guest-card-divider"></div>

</div>

<!-- HERO GRID: 2 Kolom -->
<div class="guest-landing-grid">

    <!-- CARD: Yang Perlu Disiapkan -->
    <div class="guest-card">

        <div class="guest-card-header-center">
            <h2 class="guest-card-title-center">
                Yang Perlu Disiapkan
            </h2>

            <p class="guest-card-description-center">
                Pastikan Anda menyiapkan hal berikut sebelum registrasi.
            </p>

        </div>

        <div class="guest-card-divider"></div>

        <ul class="guest-list">

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Identitas diri (KTP, SIM, Paspor, atau kartu lainnya)</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Nomor HP aktif yang dapat menerima WhatsApp</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Informasi asal instansi/perusahaan</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Tujuan kunjungan (departemen & pegawai)</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Perangkat dengan kamera untuk mengambil foto</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Tanda tangan digital</span>
            </li>

        </ul>

    </div>

    <!-- CARD: Setelah Registrasi -->
    <div class="guest-card">

        <div class="guest-card-header-center">
            <h2 class="guest-card-title-center">
                Setelah Registrasi
            </h2>

            <p class="guest-card-description-center">
                Berikut yang akan Anda dapatkan setelah registrasi.
            </p>

        </div>

        <div class="guest-card-divider"></div>

        <ul class="guest-list">

            <li class="guest-list-item">
                <i class="bi bi-qr-code"></i>
                <span>Anda akan mendapatkan kode kunjungan unik</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-qr-code-scan"></i>
                <span>Anda akan mendapatkan QR Code kunjungan</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-box-arrow-right"></i>
                <span>QR Code digunakan untuk proses checkout</span>
            </li>

            <li class="guest-list-item">
                <i class="bi bi-save"></i>
                <span>Simpan kode/QR sampai kunjungan selesai</span>
            </li>

        </ul>

    </div>

</div>

<!-- TOMBOL MULAI -->
<a
    href="<?= base_url('pendaftaran') ?>"
    class="guest-btn guest-btn-glass-primary guest-start-button">

    <i class="bi bi-arrow-right-circle"></i>

    Mulai Registrasi Kunjungan

</a>

<?= $this->endSection() ?>