<div
    class="modal fade"
    id="toggleDepartmentModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="toggleDepartmentModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-toggle-on" id="toggle_department_icon"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="toggleDepartmentModalLabel">
                            Ubah Status Bagian
                        </h2>

                        <p class="master-modal-description" id="toggle_department_description">
                            Ubah status bagian.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form id="toggleDepartmentForm" method="post" action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-note" id="toggle_department_note">
                                <i class="bi bi-info-circle" id="toggle_department_note_icon"></i>
                                <span id="toggle_department_note_text">
                                    Status bagian akan diubah.
                                </span>
                            </div>

                            <div class="master-detail-grid mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama Bagian</span>
                                    <span class="master-detail-value" id="toggle_department_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status Saat Ini</span>
                                    <span id="toggle_department_current_status">-</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary" id="toggle_department_submit">
                        <i class="bi bi-check-lg"></i> Ubah Status
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>