document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    const usersFilterForm = document.getElementById('usersFilterForm');
    const usersContent = document.getElementById('usersContent');
    const usersLoading = document.getElementById('usersLoading');

    if (usersFilterForm && usersContent) {

        usersFilterForm.addEventListener('ajax:before', function () {
            usersContent.classList.add('is-loading');

            if (usersLoading) {
                usersLoading.hidden = false;
            }
        });

        usersFilterForm.addEventListener('ajax:after', function () {
            usersContent.classList.remove('is-loading');

            if (usersLoading) {
                usersLoading.hidden = true;
            }
        });

        usersFilterForm.addEventListener('ajax:error', function () {
            usersContent.classList.remove('is-loading');

            if (usersLoading) {
                usersLoading.hidden = true;
            }
        });

    }

    function getErrorContainer(field) {
        return field.closest('.master-form-group') || field.parentNode;
    }

    function showFieldError(field, message) {
        if (!field) {
            return;
        }

        field.classList.add('is-invalid');

        const container = getErrorContainer(field);
        let errorEl = container.querySelector('.master-form-error');

        if (!errorEl) {
            errorEl = document.createElement('div');
            errorEl.className = 'master-form-error';
            container.appendChild(errorEl);
        }

        errorEl.textContent = message;
        errorEl.style.display = 'block';
    }

    function clearFieldError(field) {
        if (!field) {
            return;
        }

        field.classList.remove('is-invalid');

        const container = getErrorContainer(field);
        const errorEl = container.querySelector('.master-form-error');

        if (errorEl) {
            errorEl.textContent = '';
            errorEl.style.display = 'none';
        }
    }

    function clearAllErrors(form) {
        if (!form) {
            return;
        }

        form.querySelectorAll('.is-invalid').forEach(function (el) {
            el.classList.remove('is-invalid');
        });

        form.querySelectorAll('.master-form-error').forEach(function (el) {
            el.textContent = '';
            el.style.display = 'none';
        });
    }

    function resetForm(form) {
        if (!form) {
            return;
        }

        form.querySelectorAll('input, select, textarea').forEach(function (field) {

            if (field.type === 'hidden') {
                return;
            }

            if (field.type === 'checkbox' || field.type === 'radio') {
                field.checked = false;
            } else {
                field.value = '';
            }
        });

        clearAllErrors(form);
    }

    // Validator
    const validators = {

        username: function (value) {
            value = (value || '').trim();
            if (value === '') {
                return 'Username wajib diisi.';
            }
            if (value.length < 3) {
                return 'Username minimal 3 karakter.';
            }
            if (value.length > 50) {
                return 'Username maksimal 50 karakter.';
            }
            return null;
        },

        email: function (value) {
            value = (value || '').trim();
            if (value === '') {
                return 'Email wajib diisi.';
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return 'Email harus menggunakan format email yang valid.';
            }
            if (value.length > 255) {
                return 'Email maksimal 255 karakter.';
            }
            return null;
        },

        nomor_hp: function (value) {
            value = (value || '').trim();
            if (value === '') {
                return 'Nomor HP wajib diisi.';
            }
            if (!/^(?:\+62|62|0)8[1-9][0-9]{7,11}$/.test(value)) {
                return 'Nomor HP harus menggunakan format nomor Indonesia yang valid.';
            }
            return null;
        },

        role: function (value) {
            if (!value) {
                return 'Role wajib dipilih.';
            }
            if (!['administrator', 'petugas'].includes(value)) {
                return 'Role tidak valid.';
            }
            return null;
        },

        password: function (value) {
            if (!value) {
                return 'Password wajib diisi.';
            }
            if (value.length < 8) {
                return 'Password minimal 8 karakter.';
            }
            return null;
        },

        password_confirmation: function (value, form) {
            if (!value) {
                return 'Konfirmasi password wajib diisi.';
            }
            const passwordField = form.querySelector('[name="password"]');
            if (passwordField && value !== passwordField.value) {
                return 'Konfirmasi password harus sama dengan Password.';
            }
            return null;
        },
    };

    function validateField(field) {
        if (!field) {
            return true;
        }

        const name = field.name;
        const validator = validators[name];

        if (!validator) {
            return true;
        }

        const error = validator(field.value, field.form);

        if (error) {
            showFieldError(field, error);
            return false;
        }

        clearFieldError(field);
        return true;
    }

    function validateForm(form, fields) {
        let isValid = true;
        let firstInvalid = null;

        fields.forEach(function (fieldName) {
            const field = form.querySelector('[name="' + fieldName + '"]');
            if (!field) {
                return;
            }

            if (!validateField(field)) {
                isValid = false;
                if (!firstInvalid) {
                    firstInvalid = field;
                }
            }
        });

        if (firstInvalid) {
            firstInvalid.focus();
        }

        return isValid;
    }

    // CREATE MODAL
    const createUserModalElement =
        document.getElementById('createUserModal');

    if (createUserModalElement) {

        const hasCreateUserErrors =
            createUserModalElement.dataset.createUserError === '1';

        if (hasCreateUserErrors) {
            const createUserModal =
                bootstrap.Modal.getOrCreateInstance(createUserModalElement);
            createUserModal.show();
        }

        const createForm = createUserModalElement.querySelector('form');

        if (createForm) {

            createUserModalElement.addEventListener(
                'show.bs.modal',
                function (event) {
                    if (event.relatedTarget) {
                        resetForm(createForm);
                    }
                }
            );

            createForm.addEventListener('submit', function (event) {

                clearAllErrors(createForm);

                const isValid = validateForm(createForm, [
                    'username',
                    'email',
                    'nomor_hp',
                    'role',
                    'password',
                    'password_confirmation',
                ]);

                if (!isValid) {
                    event.preventDefault();
                }

            });

            createForm.querySelectorAll('[name]').forEach(function (field) {
                field.addEventListener('input', function () {
                    clearFieldError(field);
                });
            });

            createUserModalElement.addEventListener(
                'hidden.bs.modal',
                function () {
                    if (createUserModalElement.dataset.createUserError === '1') {
                        createUserModalElement.dataset.createUserError = '0';
                        return;
                    }
                    resetForm(createForm);
                }
            );

        }

    }

    // EDIT MODAL
    const editUserModalElement =
        document.getElementById('editUserModal');

    const editUserForm =
        document.getElementById('editUserForm');

    if (editUserModalElement && editUserForm) {

        editUserModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                const usernameInput =
                    document.getElementById('edit_username');

                const emailInput =
                    document.getElementById('edit_email');

                const nomorHpInput =
                    document.getElementById('edit_nomor_hp');

                const roleInput =
                    document.getElementById('edit_role');

                if (
                    !usernameInput ||
                    !emailInput ||
                    !nomorHpInput ||
                    !roleInput
                ) {
                    return;
                }

                if (button) {

                    resetForm(editUserForm);

                    const userId = button.dataset.userId;
                    const username = button.dataset.username;
                    const email = button.dataset.email;
                    const nomorHp = button.dataset.nomorHp;
                    const role = button.dataset.role;

                    if (!userId) {
                        return;
                    }

                    usernameInput.value = username || '';
                    emailInput.value = email || '';
                    nomorHpInput.value = nomorHp || '';
                    roleInput.value = role || '';

                    editUserForm.action =
                        baseUrl + 'admin/users/update/' + userId;

                    return;
                }

                const editUserId =
                    editUserModalElement.dataset.editUserId || '';

                if (!editUserId) {
                    return;
                }

                editUserForm.action =
                    baseUrl + 'admin/users/update/' + editUserId;

            }
        );

        editUserForm.addEventListener('submit', function (event) {

            clearAllErrors(editUserForm);

            const isValid = validateForm(editUserForm, [
                'username',
                'email',
                'nomor_hp',
                'role',
            ]);

            if (!isValid) {
                event.preventDefault();
            }

        });

        editUserForm.querySelectorAll('[name]').forEach(function (field) {
            field.addEventListener('input', function () {
                clearFieldError(field);
            });
        });

        const hasEditErrors =
            editUserModalElement.dataset.editUserError === '1';

        if (hasEditErrors) {

            setTimeout(function () {
                const editModal =
                    bootstrap.Modal.getOrCreateInstance(editUserModalElement);
                editModal.show();
            }, 100);

        }

        editUserModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                if (editUserModalElement.dataset.editUserError === '1') {
                    editUserForm.action = '';
                    editUserModalElement.dataset.editUserError = '0';  
                    return;
                }

                resetForm(editUserForm);
                editUserForm.action = '';
            }
        );
    }
    
    // SHOW MODAL
    const showUserModalElement =
        document.getElementById('showUserModal');

    if (showUserModalElement) {

        showUserModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                const username = button.dataset.username || '-';
                const email = button.dataset.email || '-';
                const nomorHp = button.dataset.nomorHp || '-';
                const role = button.dataset.role || '-';
                const status = button.dataset.status || '-';
                const createdAt = button.dataset.createdAt || '-';
                const updatedAt = button.dataset.updatedAt || '-';
                const deletedAt = button.dataset.deletedAt || '';

                document.getElementById('show_username').textContent = username;
                document.getElementById('show_email').textContent = email;
                document.getElementById('show_nomor_hp').textContent = nomorHp;
                document.getElementById('show_role').textContent = role;

                const statusElement =
                    document.getElementById('show_status');

                statusElement.innerHTML = '';

                const statusBadge =
                    document.createElement('span');

                statusBadge.className =
                    'app-badge ' +
                    (
                        status === 'Aktif'
                            ? 'app-badge-active'
                            : status === 'Nonaktif'
                                ? 'app-badge-inactive'
                                : 'app-badge-deleted'
                    );

                statusBadge.textContent = status;

                statusElement.appendChild(statusBadge);

                document.getElementById('show_created_at').textContent = createdAt;
                document.getElementById('show_updated_at').textContent = updatedAt;

                const deletedWrapper =
                    document.getElementById('show_deleted_wrapper');

                const deletedAtElement =
                    document.getElementById('show_deleted_at');

                if (deletedAt !== '') {
                    deletedAtElement.textContent = deletedAt;
                    deletedWrapper.hidden = false;
                } else {
                    deletedAtElement.textContent = '-';
                    deletedWrapper.hidden = true;
                }

            }
        );

    }

    // RESET PASSWORD MODAL
    const resetPasswordModalElement =
        document.getElementById('resetPasswordModal');

    const resetPasswordForm =
        document.getElementById('resetPasswordForm');

    if (resetPasswordModalElement && resetPasswordForm) {

        resetPasswordModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                const usernameElement =
                    document.getElementById('reset_username');

                const emailElement =
                    document.getElementById('reset_email');

                if (!usernameElement || !emailElement) {
                    return;
                }

                if (button) {

                    const userId = button.dataset.userId || '';
                    const username = button.dataset.username || '-';
                    const email = button.dataset.email || '-';

                    if (!userId) {
                        return;
                    }

                    usernameElement.textContent = username;
                    emailElement.textContent = email;

                    resetPasswordForm.action =
                        baseUrl + 'admin/users/reset-password/' + userId;

                    resetForm(resetPasswordForm);

                    return;
                }

                const resetUserId =
                    resetPasswordModalElement.dataset.resetUserId || '';

                const resetUsername =
                    resetPasswordModalElement.dataset.resetUsername || '-';

                const resetEmail =
                    resetPasswordModalElement.dataset.resetEmail || '-';

                if (!resetUserId) {
                    return;
                }

                usernameElement.textContent = resetUsername;
                emailElement.textContent = resetEmail;

                resetPasswordForm.action =
                    baseUrl + 'admin/users/reset-password/' + resetUserId;
            }
        );

        resetPasswordModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                resetForm(resetPasswordForm);
                resetPasswordForm.action = '';

            }
        );

        resetPasswordForm.addEventListener('submit', function (event) {

            clearAllErrors(resetPasswordForm);

            const isValid = validateForm(resetPasswordForm, [
                'password',
                'password_confirmation',
            ]);

            if (!isValid) {
                event.preventDefault();
            }

        });

        resetPasswordForm.querySelectorAll('[name]').forEach(function (field) {
            field.addEventListener('input', function () {
                clearFieldError(field);
            });
        });

        const hasResetErrors =
            resetPasswordModalElement.dataset.resetError === '1';

        if (hasResetErrors) {

            setTimeout(function () {
                const resetModal =
                    bootstrap.Modal.getOrCreateInstance(resetPasswordModalElement);
                resetModal.show();
            }, 100);

        }

    }

    // DELETE MODAL
    const deleteUserModalElement =
        document.getElementById('deleteUserModal');

    const deleteUserForm =
        document.getElementById('deleteUserForm');

    if (deleteUserModalElement && deleteUserForm) {

        deleteUserModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                const userId = button.dataset.userId || '';
                const username = button.dataset.username || '-';
                const email = button.dataset.email || '-';

                const usernameElement =
                    document.getElementById('delete_username');

                const emailElement =
                    document.getElementById('delete_email');

                if (!userId || !usernameElement || !emailElement) {
                    return;
                }

                usernameElement.textContent = username;
                emailElement.textContent = email;

                deleteUserForm.action =
                    baseUrl + 'admin/users/delete/' + userId;

            }
        );

        deleteUserModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                deleteUserForm.action = '';

            }
        );

    }

    // TOGGLE MODAL
    const toggleUserModalElement =
        document.getElementById('toggleUserModal');

    const toggleUserForm =
        document.getElementById('toggleUserForm');

    if (toggleUserModalElement && toggleUserForm) {

        toggleUserModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                const userId = button.dataset.userId || '';
                const username = button.dataset.username || '-';
                const email = button.dataset.email || '-';
                const isActive = button.dataset.isActive === '1';
                const statusLabel = button.dataset.statusLabel || '-';

                const usernameElement =
                    document.getElementById('toggle_username');

                const emailElement =
                    document.getElementById('toggle_email');

                if (!userId || !usernameElement || !emailElement) {
                    return;
                }

                usernameElement.textContent = username;
                emailElement.textContent = email;

                const statusElement =
                    document.getElementById('toggle_current_status');

                statusElement.innerHTML = '';

                const statusBadge =
                    document.createElement('span');

                statusBadge.className =
                    'app-badge ' +
                    (isActive ? 'app-badge-active' : 'app-badge-inactive');

                statusBadge.textContent = statusLabel;

                statusElement.appendChild(statusBadge);

                const headerIcon =
                    document.getElementById('toggle_user_icon');

                if (headerIcon) {
                    headerIcon.className = isActive
                        ? 'bi bi-person-dash'
                        : 'bi bi-person-check';
                }

                const descriptionElement =
                    document.getElementById('toggle_user_description');

                if (descriptionElement) {
                    descriptionElement.textContent = isActive
                        ? 'Nonaktifkan akun pengguna ini?'
                        : 'Aktifkan akun pengguna ini?';
                }

                const noteElement =
                    document.getElementById('toggle_user_note');

                const noteIcon =
                    document.getElementById('toggle_user_note_icon');

                const noteText =
                    document.getElementById('toggle_user_note_text');

                if (isActive) {
                    if (noteElement) {
                        noteElement.classList.add('master-form-note-danger');
                    }

                    if (noteIcon) {
                        noteIcon.className = 'bi bi-exclamation-triangle';
                    }

                    if (noteText) {
                        noteText.textContent =
                            'Pengguna tidak akan bisa login setelah dinonaktifkan. ' +
                            'Data pengguna tetap tersimpan dan dapat diaktifkan kembali.';
                    }
                } else {
                    if (noteElement) {
                        noteElement.classList.remove('master-form-note-danger');
                    }

                    if (noteIcon) {
                        noteIcon.className = 'bi bi-info-circle';
                    }

                    if (noteText) {
                        noteText.textContent =
                            'Pengguna akan dapat login kembali setelah diaktifkan.';
                    }
                }

                const submitIcon =
                    document.getElementById('toggle_user_submit_icon');

                const submitText =
                    document.getElementById('toggle_user_submit_text');

                const submitButton =
                    document.getElementById('toggle_user_submit');

                if (submitIcon) {
                    submitIcon.className = isActive
                        ? 'bi bi-person-dash'
                        : 'bi bi-person-check';
                }

                if (submitText) {
                    submitText.textContent = isActive
                        ? 'Nonaktifkan'
                        : 'Aktifkan';
                }

                if (submitButton) {
                    submitButton.classList.toggle(
                        'app-btn-primary',
                        !isActive
                    );
                    submitButton.classList.toggle(
                        'app-btn-danger',
                        isActive
                    );
                }

                toggleUserForm.action =
                    baseUrl + 'admin/users/toggle-status/' + userId;

            }

        );

        toggleUserModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                toggleUserForm.action = '';

            }
        );

    }

    // RESTORE MODAL
    const restoreUserModalElement =
        document.getElementById('restoreUserModal');

    const restoreUserForm =
        document.getElementById('restoreUserForm');

    if (restoreUserModalElement && restoreUserForm) {

        restoreUserModalElement.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                if (!button) {
                    return;
                }

                const userId = button.dataset.userId || '';
                const username = button.dataset.username || '-';
                const email = button.dataset.email || '-';

                const usernameElement =
                    document.getElementById('restore_username');

                const emailElement =
                    document.getElementById('restore_email');

                if (!userId || !usernameElement || !emailElement) {
                    return;
                }

                usernameElement.textContent = username;
                emailElement.textContent = email;

                restoreUserForm.action =
                    baseUrl + 'admin/users/restore/' + userId;

            }
        );

        restoreUserModalElement.addEventListener(
            'hidden.bs.modal',
            function () {

                restoreUserForm.action = '';

            }
        );

    }

});