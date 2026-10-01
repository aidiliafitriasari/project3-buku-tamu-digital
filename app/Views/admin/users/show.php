<div
    class="modal fade"
    id="showUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="showUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                    <div>
                        <h2
                            class="master-modal-title"
                            id="showUserModalLabel">
                            Detail Pengguna
                        </h2>

                        <p class="master-modal-description">
                            Informasi akun pengguna sistem.
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

                <div class="master-form-section">

                    <div class="master-form-section-header">

                        <div class="master-form-section-icon">
                            <i class="bi bi-person"></i>
                        </div>

                        <div>
                            <h3 class="master-form-section-title">
                                Informasi Akun
                            </h3>

                            <p class="master-form-section-description">
                                Data akun pengguna sistem.
                            </p>
                        </div>

                    </div>

                    <div class="master-detail-grid">

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Username
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_username">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Email
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_email">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Nomor HP
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_nomor_hp">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Role
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_role">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Status
                            </span>

                            <span id="show_status">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Dibuat pada
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_created_at">
                                -
                            </span>
                        </div>

                        <div class="master-detail-item">
                            <span class="master-detail-label">
                                Diperbarui pada
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_updated_at">
                                -
                            </span>
                        </div>

                        <div
                            class="master-detail-item"
                            id="show_deleted_wrapper"
                            hidden>

                            <span class="master-detail-label">
                                Dihapus pada
                            </span>

                            <span
                                class="master-detail-value"
                                id="show_deleted_at">
                                -
                            </span>

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