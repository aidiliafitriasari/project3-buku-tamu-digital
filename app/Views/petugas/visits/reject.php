<div
    class="modal fade"
    id="rejectVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="rejectVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon master-modal-icon-danger">
                        <i class="bi bi-x-circle"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="rejectVisitModalLabel">
                            Tolak Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Kunjungan akan ditolak dan tidak dapat di-check-in.
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

                    <div class="master-form-section">

                        <div class="master-form-note master-form-note-danger">
                            <i class="bi bi-exclamation-triangle"></i>
                            <div>
                                <strong>Perhatian:</strong>
                                Kunjungan yang ditolak tidak dapat dikembalikan ke status menunggu.
                            </div>
                        </div>

                        <!-- INFO -->
                        <div class="master-detail-grid" style="margin-top: 16px;">

                            <div class="master-detail-item">
                                <span class="master-detail-label">Kode Kunjungan</span>
                                <span class="master-detail-value" id="reject_visit_code">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Nama Tamu</span>
                                <span class="master-detail-value" id="reject_guest_name">-</span>
                            </div>

                        </div>

                        <!-- ALASAN -->
                        <div class="master-form-group" style="margin-top: 16px;">

                            <label for="reject_reason" class="master-form-label">
                                Alasan Penolakan
                                <span class="master-form-required">*</span>
                            </label>

                            <textarea
                                id="reject_reason"
                                name="reason"
                                class="master-form-textarea"
                                placeholder="Contoh: Data tamu tidak lengkap, tujuan tidak jelas, dll."
                                rows="3"
                                maxlength="500"
                                required></textarea>

                            <p class="master-form-error" id="reject_reason_error" hidden></p>

                            <p class="master-form-help">
                                <i class="bi bi-info-circle"></i>
                                Alasan penolakan akan dicatat pada activity log.
                            </p>

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
                    id="rejectConfirmBtn">
                    <i class="bi bi-x-circle"></i> Tolak Kunjungan
                </button>

            </div>

        </div>

    </div>

</div>