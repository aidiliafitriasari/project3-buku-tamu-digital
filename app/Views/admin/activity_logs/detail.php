<div
    class="modal fade"
    id="detailActivityLogModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="detailActivityLogModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <div>
                        <h2 class="master-modal-title" id="detailActivityLogModalLabel">
                            Detail Activity Log
                        </h2>

                        <p class="master-modal-description">
                            Informasi lengkap aktivitas yang tercatat.
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

            <div class="master-modal-body">

                <div class="master-form">

                    <div class="master-form-section">

                        <div class="master-form-section-header">

                            <div class="master-form-section-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>

                            <div>
                                <h3 class="master-form-section-title">
                                    Informasi Log
                                </h3>

                                <p class="master-form-section-description">
                                    Detail aktivitas yang tercatat.
                                </p>
                            </div>

                        </div>

                        <div class="master-detail-grid">

                            <div class="master-detail-item">
                                <span class="master-detail-label">ID Log</span>
                                <span class="master-detail-value" id="detail_log_id">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Waktu</span>
                                <span class="master-detail-value" id="detail_log_created_at">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">User</span>
                                <div>
                                    <div class="master-detail-value" id="detail_log_username">-</div>
                                    <div class="master-table-secondary" id="detail_log_role"></div>
                                </div>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Aktivitas</span>
                                <div id="detail_log_activity">-</div>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Module</span>
                                <span class="master-detail-value" id="detail_log_module">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Visit ID</span>
                                <span class="master-detail-value" id="detail_log_visit_id">-</span>
                            </div>

                            <div class="master-detail-item">
                                <span class="master-detail-label">Status History ID</span>
                                <span class="master-detail-value" id="detail_log_status_history_id">-</span>
                            </div>

                            <div class="master-detail-item master-form-group-full">
                                <span class="master-detail-label">Deskripsi</span>

                                <div class="master-detail-description" id="detail_log_description">
                                    -
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="master-modal-footer">

                <button
                    type="button"
                    class="app-btn app-btn-secondary"
                    data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>