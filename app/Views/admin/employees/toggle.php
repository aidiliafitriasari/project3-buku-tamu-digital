<div
    class="modal fade"
    id="toggleEmployeeModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="toggleEmployeeModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-person-dash" id="toggle_employee_icon"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="toggleEmployeeModalLabel">
                            Ubah Status Pegawai
                        </h2>

                        <p class="master-modal-description" id="toggle_employee_description">
                            Ubah status pegawai.
                        </p>
                    </div>

                </div>

                <button type="button" class="master-modal-close" data-bs-dismiss="modal" aria-label="Tutup">
                    <i class="bi bi-x-lg"></i>
                </button>

            </div>

            <form id="toggleEmployeeForm" method="post" action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-note" id="toggle_employee_note">
                                <i class="bi bi-info-circle" id="toggle_employee_note_icon"></i>
                                <span id="toggle_employee_note_text">
                                    Status pegawai akan diubah.
                                </span>
                            </div>

                            <div class="master-detail-grid mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Nama Pegawai</span>
                                    <span class="master-detail-value" id="toggle_employee_name">-</span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">Status Saat Ini</span>
                                    <span id="toggle_employee_current_status">-</span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button type="button" class="app-btn app-btn-ghost" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Batal
                    </button>

                    <button type="submit" class="app-btn app-btn-primary" id="toggle_employee_submit">
                        <i class="bi bi-check-lg"></i> Ubah Status
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>