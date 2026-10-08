<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/guest.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/guest/media.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/guest/consent.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="guest-page-header">
    <h1 class="guest-page-title">Registrasi Kunjungan</h1>
    <p class="guest-page-subtitle">
        Lengkapi data berikut untuk melakukan registrasi kunjungan.
    </p>
</div>

<div class="guest-progress" id="guestProgress">
    <div class="guest-progress-track">
        <div class="guest-progress-fill" id="guestProgressFill"></div>
    </div>
    <div class="guest-progress-steps">
        <div class="guest-progress-step is-active" data-step="1">
            <span class="guest-progress-dot">1</span>
            <span class="guest-progress-label">Identitas</span>
        </div>
        <div class="guest-progress-step" data-step="2">
            <span class="guest-progress-dot">2</span>
            <span class="guest-progress-label">Tujuan</span>
        </div>
        <div class="guest-progress-step" data-step="3">
            <span class="guest-progress-dot">3</span>
            <span class="guest-progress-label">Foto</span>
        </div>
        <div class="guest-progress-step" data-step="4">
            <span class="guest-progress-dot">4</span>
            <span class="guest-progress-label">Tanda Tangan</span>
        </div>
        <div class="guest-progress-step" data-step="5">
            <span class="guest-progress-dot">5</span>
            <span class="guest-progress-label">Persetujuan</span>
        </div>
    </div>
</div>

<form
    action="<?= base_url('pendaftaran') ?>"
    method="post"
    enctype="multipart/form-data"
    id="guestRegisterForm"
    data-success-url="<?= base_url('kiosk/success') ?>"
    data-photo-required="<?= ! empty($settings['photo_required']) ? '1' : '0' ?>"
    data-signature-required="<?= ! empty($settings['signature_required']) ? '1' : '0' ?>"
    data-max-photo-size="<?= esc($settings['max_photo_size'] ?? 500) ?>"
    data-employees="<?= esc(json_encode(array_map(function ($emp) {
                        return [
                            'id' => (int) $emp['id'],
                            'name' => $emp['name'],
                            'department_id' => (int) $emp['department_id'],
                        ];
                    }, $employees ?? []))) ?>"
    novalidate>

    <?= csrf_field() ?>

    <!-- STEP 1 -->
    <div class="guest-card guest-step is-active" data-step="1">

        <div class="guest-card-header">
            <div class="guest-card-icon">
                <i class="bi bi-person-vcard"></i>
            </div>
            <div>
                <h2 class="guest-card-title">Data Identitas</h2>
                <p class="guest-card-description">
                    Isi data identitas dan asal instansi Anda.
                </p>
            </div>
        </div>

        <div class="guest-form">

            <div class="guest-form-group">
                <label for="name" class="guest-form-label">
                    Nama Lengkap <span class="guest-form-required">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="guest-form-input"
                    placeholder="Contoh: Budi Santoso"
                    maxlength="100"
                    autocomplete="name"
                    required>
                <div class="guest-form-error" data-error-for="name"></div>
            </div>

            <div class="guest-form-group">
                <label for="phone" class="guest-form-label">
                    Nomor HP <span class="guest-form-required">*</span>
                </label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    class="guest-form-input"
                    placeholder="Contoh: 081234567890"
                    maxlength="20"
                    inputmode="numeric"
                    autocomplete="tel"
                    required>
                <p class="guest-form-help">
                    <i class="bi bi-info-circle"></i>
                    Nomor HP aktif yang dapat menerima WhatsApp.
                </p>
                <div class="guest-form-error" data-error-for="phone"></div>
            </div>

            <div class="guest-form-group">
                <label for="address" class="guest-form-label">
                    Alamat <span class="guest-form-required">*</span>
                </label>
                <textarea
                    id="address"
                    name="address"
                    class="guest-form-textarea"
                    placeholder="Contoh: Jl. Merdeka No. 10, Jakarta"
                    rows="3"
                    maxlength="255"
                    autocomplete="street-address"
                    required></textarea>
                <div class="guest-form-error" data-error-for="address"></div>
            </div>

            <div class="guest-form-group">
                <label for="identity_type" class="guest-form-label">
                    Jenis Identitas <span class="guest-form-required">*</span>
                </label>
                <select
                    id="identity_type"
                    name="identity_type"
                    class="guest-form-select"
                    required>
                    <option value="">— Pilih Jenis Identitas —</option>
                    <option value="ktp">KTP</option>
                    <option value="sim">SIM</option>
                    <option value="paspor">Paspor</option>
                    <option value="kartu_pelajar">Kartu Pelajar</option>
                    <option value="kartu_mahasiswa">Kartu Mahasiswa</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                <div class="guest-form-error" data-error-for="identity_type"></div>
            </div>

            <div class="guest-form-group">
                <label for="identity_number" class="guest-form-label">
                    Nomor Identitas <span class="guest-form-required">*</span>
                </label>
                <input
                    type="text"
                    id="identity_number"
                    name="identity_number"
                    class="guest-form-input"
                    placeholder="Pilih jenis identitas terlebih dahulu"
                    maxlength="50"
                    required>
                <p class="guest-form-help" id="identityHelp">
                    <i class="bi bi-info-circle"></i>
                    Format akan disesuaikan dengan jenis identitas.
                </p>
                <div class="guest-form-error" data-error-for="identity_number"></div>
            </div>

            <div class="guest-form-group">
                <label for="origin_institution" class="guest-form-label">
                    Asal Instansi / Perusahaan <span class="guest-form-required">*</span>
                </label>
                <input
                    type="text"
                    id="origin_institution"
                    name="origin_institution"
                    class="guest-form-input"
                    placeholder="Contoh: PT Maju Jaya"
                    maxlength="150"
                    required>
                <div class="guest-form-error" data-error-for="origin_institution"></div>
            </div>

        </div>

        <div class="guest-form-actions">
            <div></div>
            <button type="button" class="guest-btn guest-btn-primary" data-next="2">
                Lanjut <i class="bi bi-arrow-right"></i>
            </button>
        </div>

    </div>

    <!-- STEP 2 -->
    <div class="guest-card guest-step" data-step="2">

        <div class="guest-card-header">
            <div class="guest-card-icon">
                <i class="bi bi-signpost-split"></i>
            </div>
            <div>
                <h2 class="guest-card-title">Tujuan & Keperluan</h2>
                <p class="guest-card-description">
                    Pilih tujuan kunjungan dan keperluan Anda.
                </p>
            </div>
        </div>

        <div class="guest-form">

            <div class="guest-form-group">
                <label for="department_id" class="guest-form-label">
                    Departemen / Bagian Tujuan <span class="guest-form-required">*</span>
                </label>
                <select
                    id="department_id"
                    name="department_id"
                    class="guest-form-select"
                    required>
                    <option value="">— Pilih Departemen —</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= esc($dept['id']) ?>">
                            <?= esc($dept['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="guest-form-error" data-error-for="department_id"></div>
            </div>

            <div class="guest-form-group">
                <label for="employee_id" class="guest-form-label">
                    Pegawai Tujuan <span class="guest-form-required">*</span>
                </label>
                <select
                    id="employee_id"
                    name="employee_id"
                    class="guest-form-select"
                    disabled
                    required>
                    <option value="">— Pilih Departemen Terlebih Dahulu —</option>
                </select>
                <div class="guest-form-error" data-error-for="employee_id"></div>
            </div>

            <div class="guest-form-group">
                <label for="visit_purpose_id" class="guest-form-label">
                    Keperluan Kunjungan <span class="guest-form-required">*</span>
                </label>
                <select
                    id="visit_purpose_id"
                    name="visit_purpose_id"
                    class="guest-form-select"
                    required>
                    <option value="">— Pilih Keperluan —</option>
                    <?php foreach ($visitPurposes as $purpose): ?>
                        <option value="<?= esc($purpose['id']) ?>">
                            <?= esc($purpose['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="guest-form-error" data-error-for="visit_purpose_id"></div>
            </div>

            <div class="guest-form-group">
                <label for="group_count" class="guest-form-label">
                    Jumlah Rombongan <span class="guest-form-required">*</span>
                </label>
                <input
                    type="number"
                    id="group_count"
                    name="group_count"
                    class="guest-form-input"
                    value="1"
                    min="1"
                    max="100"
                    inputmode="numeric"
                    required>
                <p class="guest-form-help">
                    <i class="bi bi-info-circle"></i>
                    Minimal 1 orang (termasuk Anda).
                </p>
                <div class="guest-form-error" data-error-for="group_count"></div>
            </div>

        </div>

        <div class="guest-form-actions">
            <button type="button" class="guest-btn guest-btn-secondary" data-prev="1">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
            <button type="button" class="guest-btn guest-btn-primary" data-next="3">
                Lanjut <i class="bi bi-arrow-right"></i>
            </button>
        </div>

    </div>

    <!-- STEP 3 -->
    <div class="guest-card guest-step" data-step="3">

        <div class="guest-card-header">
            <div class="guest-card-icon">
                <i class="bi bi-camera"></i>
            </div>
            <div>
                <h2 class="guest-card-title">Foto Tamu</h2>
                <p class="guest-card-description">
                    Ambil foto Anda menggunakan kamera.
                </p>
            </div>
        </div>

        <div class="guest-camera" id="guestCamera">

            <div class="guest-camera-preview" id="guestCameraPreview">
                <video id="guestCameraVideo" autoplay playsinline muted></video>
                <img id="guestCameraPhoto" alt="Preview Foto" hidden>
                <div class="guest-camera-placeholder" id="guestCameraPlaceholder">
                    <i class="bi bi-camera-video"></i>
                    <p>Kamera belum aktif</p>
                </div>
            </div>

            <div class="guest-camera-actions">
                <button type="button" class="guest-btn guest-btn-primary" id="guestCameraStart">
                    <i class="bi bi-camera-video"></i> Buka Kamera
                </button>
                <button type="button" class="guest-btn guest-btn-primary" id="guestCameraCapture" hidden>
                    <i class="bi bi-camera"></i> Ambil Foto
                </button>
                <button type="button" class="guest-btn guest-btn-secondary" id="guestCameraRetake" hidden>
                    <i class="bi bi-arrow-counterclockwise"></i> Foto Ulang
                </button>
                <button type="button" class="guest-btn guest-btn-secondary" id="guestCameraStop" hidden>
                    <i class="bi bi-x-circle"></i> Tutup Kamera
                </button>
            </div>

            <div class="guest-camera-error" id="guestCameraError" hidden>
                <i class="bi bi-exclamation-triangle"></i>
                <p>Kamera tidak dapat digunakan. Silakan izinkan akses kamera atau gunakan upload foto.</p>
            </div>

            <div class="guest-camera-fallback" id="guestCameraFallback" hidden>
                <label for="photo_fallback" class="guest-form-label">
                    Upload Foto (Fallback)
                </label>
                <input
                    type="file"
                    id="photo_fallback"
                    class="guest-form-input"
                    accept="image/jpeg,image/png,image/webp">
            </div>

        </div>

        <div class="guest-form-error" data-error-for="photo"></div>

        <div class="guest-form-actions">
            <button type="button" class="guest-btn guest-btn-secondary" data-prev="2">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
            <button type="button" class="guest-btn guest-btn-primary" data-next="4">
                Lanjut <i class="bi bi-arrow-right"></i>
            </button>
        </div>

    </div>

    <!-- STEP 4 -->
    <div class="guest-card guest-step" data-step="4">

        <div class="guest-card-header">
            <div class="guest-card-icon">
                <i class="bi bi-vector-pen"></i>
            </div>
            <div>
                <h2 class="guest-card-title">Tanda Tangan</h2>
                <p class="guest-card-description">
                    Bubuhkan tanda tangan Anda pada area berikut.
                </p>
            </div>
        </div>

        <div class="guest-signature" id="guestSignature">
            <canvas id="guestSignatureCanvas" class="guest-signature-canvas"></canvas>
            <div class="guest-signature-actions">
                <button type="button" class="guest-btn guest-btn-secondary" id="guestSignatureClear">
                    <i class="bi bi-eraser"></i> Hapus
                </button>
                <button type="button" class="guest-btn guest-btn-secondary" id="guestSignatureReset">
                    <i class="bi bi-arrow-counterclockwise"></i> Ulangi
                </button>
            </div>
        </div>

        <div class="guest-form-error" data-error-for="signature"></div>

        <div class="guest-form-actions">
            <button type="button" class="guest-btn guest-btn-secondary" data-prev="3">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
            <button type="button" class="guest-btn guest-btn-primary" data-next="5">
                Lanjut <i class="bi bi-arrow-right"></i>
            </button>
        </div>

    </div>

    <!-- STEP 5 -->
    <div class="guest-card guest-step" data-step="5">

        <div class="guest-card-header">
            <div class="guest-card-icon">
                <i class="bi bi-shield-check"></i>
            </div>
            <div>
                <h2 class="guest-card-title">Persetujuan Penggunaan Data</h2>
                <p class="guest-card-description">
                    Bacalah informasi berikut sebelum melanjutkan.
                </p>
            </div>
        </div>

        <div class="guest-consent">
            <p class="guest-consent-text">
                Data yang Anda berikan (nama, nomor HP, alamat, identitas,
                foto, dan tanda tangan) akan digunakan untuk keperluan
                kunjungan dan pencatatan tamu di instansi ini. Data tidak
                akan disebarkan ke pihak ketiga tanpa izin Anda.
            </p>

            <label class="guest-consent-checkbox">
                <input
                    type="checkbox"
                    id="data_consent"
                    name="data_consent"
                    value="1"
                    required>
                <span>
                    Saya menyetujui penggunaan data yang saya berikan
                    untuk keperluan kunjungan sesuai ketentuan yang berlaku.
                </span>
            </label>

            <div class="guest-form-error" data-error-for="data_consent"></div>
        </div>

        <div class="guest-form-actions">
            <button type="button" class="guest-btn guest-btn-secondary" data-prev="4">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
            <button type="submit" class="guest-btn guest-btn-primary" id="guestSubmitBtn">
                <i class="bi bi-check-circle"></i> Kirim Registrasi
            </button>
        </div>

    </div>

</form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/kiosk.js') ?>"></script>
<script src="<?= base_url('assets/js/guest.js') ?>"></script>
<script src="<?= base_url('assets/js/camera.js') ?>"></script>
<script src="<?= base_url('assets/js/signature.js') ?>"></script>
<?= $this->endSection() ?>