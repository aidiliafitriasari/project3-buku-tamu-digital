<div
    class="modal fade"
    id="verifyVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="verifyVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="verifyVisitModalLabel">
                            Verifikasi Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Periksa data tamu sebelum melakukan check-in.
                        </p>
                    </div>

                </div>

                <button
                    type="button"
                    class="master-modal-close"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <!-- BODY -->
            <div class="master-modal-body">

                <div class="master-form">

                    <!-- LOADING -->
                    <div id="verifyLoading" class="app-loading">
                        <div class="app-loading-spinner"></div>
                        <span>Memuat data...</span>
                    </div>

                    <!-- CONTENT -->
                    <div id="verifyContent" hidden>

                        <!-- INFO KUNJUNGAN -->
                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Informasi Kunjungan
                                    </h3>

                                    <p class="master-form-section-description">
                                        Data kunjungan yang tercatat.
                                    </p>
                                </div>

                            </div>

                            <div class="master-detail-grid">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Kode Kunjungan</span>
                                    <span class="master-detail-value" id="verify_visit_code">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Asal Instansi</span>
                                    <span class="master-detail-value" id="verify_origin_institution">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Departemen Tujuan</span>
                                    <span class="master-detail-value" id="verify_department_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Pegawai Tujuan</span>
                                    <span class="master-detail-value" id="verify_employee_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Keperluan</span>
                                    <span class="master-detail-value" id="verify_purpose_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Jumlah Rombongan</span>
                                    <span class="master-detail-value" id="verify_group_count">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Waktu Kedatangan</span>
                                    <span class="master-detail-value" id="verify_arrival_at">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status</span>
                                    <span class="master-detail-value" id="verify_status">-</span>
                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- INFO TAMU -->
                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Informasi Tamu
                                    </h3>

                                    <p class="master-form-section-description">
                                        Data identitas tamu.
                                    </p>
                                </div>

                            </div>

                            <div class="master-detail-grid">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama</span>
                                    <span class="master-detail-value" id="verify_guest_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nomor HP</span>
                                    <span class="master-detail-value" id="verify_phone">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Alamat</span>
                                    <span class="master-detail-value" id="verify_address">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Jenis Identitas</span>
                                    <span class="master-detail-value" id="verify_identity_type">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nomor Identitas</span>
                                    <span class="master-detail-value" id="verify_identity_number">-</span>
                                </div>

                                <!-- FOTO -->
                                <div class="master-detail-item master-form-group-full">
                                    <span class="master-detail-label">Foto</span>
                                    <div id="verify_photo_wrapper">
                                        <img
                                            id="verify_photo"
                                            src=""
                                            alt="Foto Tamu"
                                            class="master-detail-logo"
                                            style="max-width: 200px;">
                                        <span id="verify_photo_empty" class="master-detail-value" hidden>
                                            Tidak ada foto
                                        </span>
                                    </div>
                                </div>

                                <!-- TANDA TANGAN -->
                                <div class="master-detail-item master-form-group-full">
                                    <span class="master-detail-label">Tanda Tangan</span>
                                    <div id="verify_signature_wrapper">
                                        <img
                                            id="verify_signature"
                                            src=""
                                            alt="Tanda Tangan"
                                            class="master-detail-logo"
                                            style="max-width: 200px;">
                                        <span id="verify_signature_empty" class="master-detail-value" hidden>
                                            Tidak ada tanda tangan
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- HASIL VERIFIKASI -->
                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-check2-square"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Hasil Verifikasi
                                    </h3>

                                    <p class="master-form-section-description">
                                        Pilih hasil verifikasi kunjungan.
                                    </p>
                                </div>

                            </div>

                            <div id="verify_error" class="app-alert app-alert-danger" hidden>
                                <i class="bi bi-exclamation-triangle"></i>
                                <span id="verify_error_text"></span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="master-modal-footer">

                <button
                    type="button"
                    class="app-btn app-btn-ghost"
                    data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i> Batal
                </button>

                <button
                    type="button"
                    class="app-btn app-btn-danger"
                    id="verifyRejectBtn">
                    <i class="bi bi-x-circle"></i> Tolak
                </button>

                <button
                    type="button"
                    class="app-btn app-btn-primary"
                    id="verifyCheckinBtn">
                    <i class="bi bi-check-circle"></i> Check-in
                </button>

            </div>

        </div>

    </div>

</div>