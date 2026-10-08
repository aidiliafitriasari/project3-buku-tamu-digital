<div
    class="modal fade"
    id="restoreVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="restoreVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon master-modal-icon-success">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="restoreVisitModalLabel">
                            Pulihkan Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Data kunjungan akan dipulihkan ke daftar aktif.
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

                        <div class="master-form-note master-form-note-success">
                            <i class="bi bi-check-circle"></i>
                            <div>
                                Data kunjungan akan dikembalikan ke daftar kunjungan aktif.
                            </div>
                        </div>

                        <div class="master-detail-grid" style="margin-top: 16px;">

                            <div class="master-detail-item">
                                <span class="master-detail-label">Kode Kunjungan</span>
                                <span class="master-detail-value" id="restore_visit_code">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Nama Tamu</span>
                                <span class="master-detail-value" id="restore_guest_name">-</span>
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

                <form
                    id="restoreVisitForm"
                    method="post"
                    action=""
                    class="d-inline">

                    <?= csrf_field() ?>

                    <input type="hidden" name="from" id="restore_from" value="aktif">
                    <input type="hidden" name="menu" id="restore_menu" value="aktif">

                    <button
                        type="submit"
                        class="app-btn app-btn-success"
                        id="restoreConfirmBtn">
                        <i class="bi bi-arrow-counterclockwise"></i> Pulihkan Kunjungan
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>