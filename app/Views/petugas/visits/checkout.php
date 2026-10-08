<div
    class="modal fade"
    id="checkoutVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="checkoutVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="checkoutVisitModalLabel">
                            Checkout Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Konfirmasi checkout untuk mengakhiri kunjungan.
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
                    <div id="checkoutLoading" class="app-loading">
                        <div class="app-loading-spinner"></div>
                        <span>Memuat data...</span>
                    </div>

                    <!-- CONTENT -->
                    <div id="checkoutContent" hidden>

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
                                        Periksa data sebelum checkout.
                                    </p>
                                </div>

                            </div>

                            <div class="master-detail-grid">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Kode Kunjungan</span>
                                    <span class="master-detail-value" id="checkout_visit_code">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama Tamu</span>
                                    <span class="master-detail-value" id="checkout_guest_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Departemen</span>
                                    <span class="master-detail-value" id="checkout_department_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Pegawai</span>
                                    <span class="master-detail-value" id="checkout_employee_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Waktu Check-in</span>
                                    <span class="master-detail-value" id="checkout_checkin_at">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Durasi</span>
                                    <span class="master-detail-value" id="checkout_duration">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status</span>
                                    <span class="master-detail-value" id="checkout_status">-</span>
                                </div>

                            </div>

                            <div class="master-form-note" style="margin-top: 16px;">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    Setelah checkout, status kunjungan akan berubah menjadi <strong>Selesai</strong> dan durasi akan dihitung otomatis.
                                </div>
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
                    class="app-btn app-btn-primary"
                    id="checkoutConfirmBtn">
                    <i class="bi bi-box-arrow-right"></i> Konfirmasi Checkout
                </button>

            </div>

        </div>

    </div>

</div>