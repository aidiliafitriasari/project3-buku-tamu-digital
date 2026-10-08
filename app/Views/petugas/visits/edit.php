<div
    class="modal fade"
    id="editVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="editVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-pencil"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="editVisitModalLabel">
                            Edit Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Perbaiki data kunjungan yang tidak sesuai.
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
                    <div id="editLoading" class="app-loading">
                        <div class="app-loading-spinner"></div>
                        <span>Memuat data...</span>
                    </div>

                    <!-- ERROR -->
                    <div id="editError" class="app-alert app-alert-danger" hidden>
                        <i class="bi bi-exclamation-triangle"></i>
                        <span id="editErrorText">Gagal memuat data.</span>
                    </div>

                    <!-- FORM -->
                    <form id="editVisitForm" hidden>

                        <input type="hidden" id="edit_visit_id" name="visit_id">

                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-info-circle"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Informasi Kunjungan
                                    </h3>

                                    <p class="master-form-section-description">
                                        Data sistem yang tidak dapat diubah.
                                    </p>
                                </div>

                            </div>

                            <div class="master-detail-grid">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Kode Kunjungan</span>
                                    <span class="master-detail-value" id="edit_visit_code">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status</span>
                                    <span class="master-detail-value" id="edit_status">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Waktu Kedatangan</span>
                                    <span class="master-detail-value" id="edit_arrival_at">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Waktu Check-in</span>
                                    <span class="master-detail-value" id="edit_checkin_at">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Waktu Check-out</span>
                                    <span class="master-detail-value" id="edit_checkout_at">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Durasi</span>
                                    <span class="master-detail-value" id="edit_duration">-</span>
                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- DATA TAMU -->
                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-person-vcard"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Data Tamu
                                    </h3>

                                    <p class="master-form-section-description">
                                        Identitas tamu yang dapat diperbaiki.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group">
                                    <label for="edit_name" class="master-form-label">
                                        Nama Lengkap
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="edit_name"
                                        name="name"
                                        class="master-form-input"
                                        maxlength="100"
                                        required>
                                    <p class="master-form-error" id="edit_error_name" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_phone" class="master-form-label">
                                        Nomor HP
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="edit_phone"
                                        name="phone"
                                        class="master-form-input"
                                        maxlength="20"
                                        required>
                                    <p class="master-form-error" id="edit_error_phone" hidden></p>
                                </div>

                                <div class="master-form-group master-form-group-full">
                                    <label for="edit_address" class="master-form-label">
                                        Alamat
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <textarea
                                        id="edit_address"
                                        name="address"
                                        class="master-form-textarea"
                                        rows="2"
                                        maxlength="255"
                                        required></textarea>
                                    <p class="master-form-error" id="edit_error_address" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_identity_type" class="master-form-label">
                                        Jenis Identitas
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <select
                                        id="edit_identity_type"
                                        name="identity_type"
                                        class="master-form-select"
                                        required>
                                        <option value="">Pilih Jenis Identitas</option>
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                        <option value="paspor">Paspor</option>
                                        <option value="kartu_pelajar">Kartu Pelajar</option>
                                        <option value="kartu_mahasiswa">Kartu Mahasiswa</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <p class="master-form-error" id="edit_error_identity_type" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_identity_number" class="master-form-label">
                                        Nomor Identitas
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="edit_identity_number"
                                        name="identity_number"
                                        class="master-form-input"
                                        maxlength="50"
                                        required>
                                    <p class="master-form-error" id="edit_error_identity_number" hidden></p>
                                </div>

                            </div>

                        </div>

                        <div class="master-section-divider"></div>

                        <!-- DATA KUNJUNGAN -->
                        <div class="master-form-section">

                            <div class="master-form-section-header">

                                <div class="master-form-section-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>

                                <div>
                                    <h3 class="master-form-section-title">
                                        Data Kunjungan
                                    </h3>

                                    <p class="master-form-section-description">
                                        Tujuan dan keperluan kunjungan.
                                    </p>
                                </div>

                            </div>

                            <div class="master-form-grid">

                                <div class="master-form-group master-form-group-full">
                                    <label for="edit_origin_institution" class="master-form-label">
                                        Asal Instansi/Perusahaan
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="edit_origin_institution"
                                        name="origin_institution"
                                        class="master-form-input"
                                        maxlength="150"
                                        required>
                                    <p class="master-form-error" id="edit_error_origin_institution" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_department_id" class="master-form-label">
                                        Departemen Tujuan
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <select
                                        id="edit_department_id"
                                        name="department_id"
                                        class="master-form-select"
                                        required>
                                        <option value="">Pilih Departemen</option>
                                    </select>
                                    <p class="master-form-error" id="edit_error_department_id" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_employee_id" class="master-form-label">
                                        Pegawai Tujuan
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <select
                                        id="edit_employee_id"
                                        name="employee_id"
                                        class="master-form-select"
                                        required>
                                        <option value="">Pilih Pegawai</option>
                                    </select>
                                    <p class="master-form-error" id="edit_error_employee_id" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_visit_purpose_id" class="master-form-label">
                                        Keperluan Kunjungan
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <select
                                        id="edit_visit_purpose_id"
                                        name="visit_purpose_id"
                                        class="master-form-select"
                                        required>
                                        <option value="">Pilih Keperluan</option>
                                    </select>
                                    <p class="master-form-error" id="edit_error_visit_purpose_id" hidden></p>
                                </div>

                                <div class="master-form-group">
                                    <label for="edit_group_count" class="master-form-label">
                                        Jumlah Rombongan
                                        <span class="master-form-required">*</span>
                                    </label>
                                    <input
                                        type="number"
                                        id="edit_group_count"
                                        name="group_count"
                                        class="master-form-input"
                                        min="1"
                                        max="100"
                                        required>
                                    <p class="master-form-error" id="edit_error_group_count" hidden></p>
                                </div>

                            </div>

                        </div>

                    </form>

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
                    type="submit"
                    form="editVisitForm"
                    class="app-btn app-btn-primary"
                    id="editSubmitBtn"
                    disabled>
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>

            </div>

        </div>

    </div>

</div>