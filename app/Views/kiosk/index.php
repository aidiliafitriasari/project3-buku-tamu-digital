<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('content') ?>

<div class="kiosk-card">

    <div class="kiosk-card-header">

        <div class="kiosk-card-icon">
            <i class="bi bi-journal-text"></i>
        </div>

        <div>
            <h2 class="kiosk-card-title">
                Selamat Datang
            </h2>
            <p class="kiosk-card-description">
                Silakan lakukan registrasi kunjungan sebelum masuk ke area instansi.
            </p>
        </div>

    </div>

</div>

<div class="kiosk-hero-grid">

    <div class="kiosk-card">

        <div class="kiosk-card-header">

            <div class="kiosk-card-icon">
                <i class="bi bi-clipboard-check"></i>
            </div>

            <div>
                <h2 class="kiosk-card-title">
                    Yang Perlu Disiapkan
                </h2>
                <p class="kiosk-card-description">
                    Pastikan Anda menyiapkan hal berikut.
                </p>
            </div>

        </div>

        <ul class="kiosk-list">

            <li class="kiosk-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Identitas diri (KTP, SIM, Paspor, atau kartu lainnya)</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Nomor HP aktif</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Informasi asal instansi/perusahaan</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-check-circle-fill"></i>
                <span>Tujuan kunjungan (departemen & pegawai)</span>
            </li>

        </ul>

    </div>

    <div class="kiosk-card">

        <div class="kiosk-card-header">

            <div class="kiosk-card-icon">
                <i class="bi bi-info-circle"></i>
            </div>

            <div>
                <h2 class="kiosk-card-title">
                    Setelah Registrasi
                </h2>
                <p class="kiosk-card-description">
                    Berikut yang akan Anda dapatkan.
                </p>
            </div>

        </div>

        <ul class="kiosk-list">

            <li class="kiosk-list-item">
                <i class="bi bi-qr-code"></i>
                <span>Kode kunjungan unik</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-qr-code-scan"></i>
                <span>QR Code kunjungan</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-box-arrow-right"></i>
                <span>QR Code untuk checkout</span>
            </li>

            <li class="kiosk-list-item">
                <i class="bi bi-save"></i>
                <span>Simpan kode/QR sampai selesai</span>
            </li>

        </ul>

    </div>

</div>

<a
    href="<?= base_url('kiosk/register') ?>"
    class="kiosk-btn kiosk-btn-primary kiosk-btn-block">

    <i class="bi bi-arrow-right-circle"></i>

    Mulai Registrasi Kunjungan

</a>

<?= $this->endSection() ?>