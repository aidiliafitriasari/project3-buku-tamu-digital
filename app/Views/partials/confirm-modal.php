<div
    class="modal fade"
    id="appConfirmModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="appConfirmModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <!-- HEADER -->
            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon" id="appConfirmIcon">
                        <i class="bi bi-question-circle"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="appConfirmModalLabel">
                            Konfirmasi
                        </h2>

                        <p class="master-modal-description" id="appConfirmDescription">
                            Apakah Anda yakin?
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

                        <p id="appConfirmMessage" style="color: var(--app-text-primary); font-size: 14px; line-height: 1.6; margin: 0;">
                            Apakah Anda yakin?
                        </p>

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="master-modal-footer">

                <button
                    type="button"
                    class="app-btn app-btn-ghost"
                    data-bs-dismiss="modal"
                    id="appConfirmCancelBtn">
                    <i class="bi bi-x-lg"></i> Batal
                </button>

                <button
                    type="button"
                    class="app-btn app-btn-primary"
                    id="appConfirmOkBtn">
                    <i class="bi bi-check-circle"></i> Ya, Lanjutkan
                </button>

            </div>

        </div>

    </div>

</div>