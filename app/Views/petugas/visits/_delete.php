<div
    class="modal fade"
    id="deleteVisitModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteVisitModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon master-modal-icon-danger">
                        <i class="bi bi-trash"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="deleteVisitModalLabel">
                            Hapus Kunjungan
                        </h2>

                        <p class="master-modal-description">
                            Data kunjungan akan dihapus (soft delete).
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
                                Data yang dihapus tidak akan muncul di daftar kunjungan aktif.
                                Data masih dapat dipulihkan oleh Administrator melalui menu <strong>Terhapus</strong>.
                            </div>
                        </div>

                        <!-- INFO -->
                        <div class="master-detail-grid" style="margin-top: 16px;">

                            <div class="master-detail-item">
                                <span class="master-detail-label">Kode Kunjungan</span>
                                <span class="master-detail-value" id="delete_visit_code">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Nama Tamu</span>
                                <span class="master-detail-value" id="delete_guest_name">-</span>
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
                    id="deleteVisitForm"
                    method="post"
                    action=""
                    class="d-inline">

                    <?= csrf_field() ?>

                    <input type="hidden" name="from" id="delete_from" value="aktif">
                    <input type="hidden" name="menu" id="delete_menu" value="aktif">

                    <button
                        type="submit"
                        class="app-btn app-btn-danger"
                        id="deleteConfirmBtn">
                        <i class="bi bi-trash"></i> Hapus Kunjungan
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>