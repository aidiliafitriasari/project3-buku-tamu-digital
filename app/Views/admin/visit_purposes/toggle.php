<div
    class="modal fade"
    id="toggleVisitPurposeModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="toggleVisitPurposeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-toggle-on" id="toggle_purpose_icon"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="toggleVisitPurposeModalLabel">
                            Ubah Status Keperluan
                        </h2>

                        <p class="master-modal-description" id="toggle_purpose_description">
                            Ubah status keperluan.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form id="toggleVisitPurposeForm" method="post" action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-note" id="toggle_purpose_note">
                                <i class="bi bi-info-circle" id="toggle_purpose_note_icon"></i>
                                <span id="toggle_purpose_note_text">
                                    Status keperluan akan diubah.
                                </span>
                            </div>

                            <div class="master-detail-grid mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama Keperluan</span>
                                    <span class="master-detail-value" id="toggle_purpose_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status Saat Ini</span>
                                    <span id="toggle_purpose_current_status">-</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary" id="toggle_purpose_submit">
                        <i class="bi bi-check-lg"></i> Ubah Status
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>