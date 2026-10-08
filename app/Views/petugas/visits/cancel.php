<div
    class="modal fade"
    id="cancelVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="cancelVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon master-modal-icon-danger">
                        <i class="bi bi-slash-circle"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="cancelVisitModalLabel">
                            Batalkan Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Kunjungan akan dibatalkan dan tidak dapat dikembalikan.
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
                                Kunjungan yang dibatalkan tidak dapat dikembalikan ke status menunggu.
                            </div>
                        </div>

                        <!-- INFO -->
                        <div class="master-detail-grid" style="margin-top: 16px;">

                            <div class="master-detail-item">
                                <span class="master-detail-label">Kode Kunjungan</span>
                                <span class="master-detail-value" id="cancel_visit_code">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Nama Tamu</span>
                                <span class="master-detail-value" id="cancel_guest_name">-</span>
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
                    id="cancelConfirmBtn">
                    <i class="bi bi-slash-circle"></i> Batalkan Kunjungan
                </button>

            </div>

        </div>

    </div>

</div>