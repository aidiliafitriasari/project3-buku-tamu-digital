<div
    class="modal fade"
    id="toggleUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="toggleUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div
                        class="master-modal-icon"
                        id="toggle_user_icon_wrapper">
                        <i
                            class="bi bi-person-dash"
                            id="toggle_user_icon"></i>
                    </div>

                    <div>
                        <h2
                            class="master-modal-title"
                            id="toggleUserModalLabel">
                            Ubah Status Pengguna
                        </h2>

                        <p
                            class="master-modal-description"
                            id="toggle_user_description">
                            Aktifkan atau nonaktifkan akun pengguna.
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

            <form
                id="toggleUserForm"
                method="post"
                action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div
                                class="master-form-note"
                                id="toggle_user_note">
                                <i
                                    class="bi bi-info-circle"
                                    id="toggle_user_note_icon"></i>

                                <span id="toggle_user_note_text">
                                    Status pengguna akan diubah.
                                </span>
                            </div>

                            <div class="master-detail-list mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Username
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="toggle_username">
                                        -
                                    </span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Email
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="toggle_email">
                                        -
                                    </span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Status Saat Ini
                                    </span>

                                    <span id="toggle_current_status">
                                        -
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="master-modal-footer">

                    <button
                        type="button"
                        class="app-btn app-btn-ghost"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="app-btn app-btn-primary"
                        id="toggle_user_submit">
                        <i
                            class="bi bi-check-lg"
                            id="toggle_user_submit_icon"></i>
                        <span id="toggle_user_submit_text">
                            Konfirmasi
                        </span>
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>