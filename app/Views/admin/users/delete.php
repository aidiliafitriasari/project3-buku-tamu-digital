<div
    class="modal fade"
    id="deleteUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content master-modal-content">

            <div class="master-modal-header">

                <div class="master-modal-header-info">

                    <div class="master-modal-icon master-modal-icon-danger">
                        <i class="bi bi-trash"></i>
                    </div>

                    <div>
                        <h2
                            class="master-modal-title"
                            id="deleteUserModalLabel">
                            Hapus Pengguna
                        </h2>

                        <p class="master-modal-description">
                            Data pengguna akan dipindahkan ke status Terhapus.
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
                id="deleteUserForm"
                method="post"
                action="">

                <?= csrf_field() ?>

                <div class="master-modal-body">

                    <div class="master-form">

                        <div class="master-form-section">

                            <div class="master-form-note master-form-note-danger">

                                <i class="bi bi-exclamation-triangle"></i>

                                <span>
                                    Data yang dihapus tidak akan muncul di daftar aktif.
                                    Administrator masih dapat memulihkannya melalui filter
                                    <strong>Terhapus</strong>.
                                </span>

                            </div>

                            <div class="master-detail-list mt-3">

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Username
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="delete_username">
                                        -
                                    </span>
                                </div>

                                <div class="master-detail-item">
                                    <span class="master-detail-label">
                                        Email
                                    </span>

                                    <span
                                        class="master-detail-value"
                                        id="delete_email">
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
                        class="app-btn app-btn-danger">
                        <i class="bi bi-trash"></i>
                        Hapus Pengguna
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>