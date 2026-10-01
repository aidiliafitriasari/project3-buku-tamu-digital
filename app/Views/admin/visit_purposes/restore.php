<div
    class="modal fade"
    id="restoreVisitPurposeModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="restoreVisitPurposeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="restoreVisitPurposeModalLabel">
                            Pulihkan Keperluan
                        </h2>

                        <p class="master-modal-description">
                            Data keperluan akan dikembalikan ke daftar aktif.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form id="restoreVisitPurposeForm" method="post" action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-note">
                                <i class="bi bi-info-circle"></i>
                                <span>
                                    Data keperluan akan dikembalikan ke daftar aktif.
                                </span>
                            </div>

                            <div class="master-detail-grid mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama Keperluan</span>
                                    <span class="master-detail-value" id="restore_purpose_name">-</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary">
                        <i class="bi bi-arrow-counterclockwise"></i> Pulihkan Keperluan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>