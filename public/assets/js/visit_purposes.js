document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    const filterForm = document.getElementById('visitPurposesFilterForm');
    const content = document.getElementById('visitPurposesContent');
    const loading = document.getElementById('visitPurposesLoading');

    if (filterForm && content) {

        filterForm.addEventListener('ajax:before', function () {
            content.classList.add('is-loading');
            if (loading) loading.hidden = false;
        });

        filterForm.addEventListener('ajax:after', function () {
            content.classList.remove('is-loading');
            if (loading) loading.hidden = true;
        });

        filterForm.addEventListener('ajax:error', function () {
            content.classList.remove('is-loading');
            if (loading) loading.hidden = true;
        });
    }

    function getErrorContainer(field) {
        return field.closest('.master-form-group') || field.parentNode;
    }

    function showFieldError(field, message) {
        if (!field) return;

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
        if (!field) return;

        field.classList.remove('is-invalid');

        const container = getErrorContainer(field);
        const errorEl = container.querySelector('.master-form-error');

        if (errorEl) {
            errorEl.textContent = '';
            errorEl.style.display = 'none';
        }
    }

    function clearAllErrors(form) {
        if (!form) return;

        form.querySelectorAll('.is-invalid').forEach(function (el) {
            el.classList.remove('is-invalid');
        });

        form.querySelectorAll('.master-form-error').forEach(function (el) {
            el.textContent = '';
            el.style.display = 'none';
        });
    }

    function resetForm(form) {
        if (!form) return;

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


    // VALIDATORS
    const validators = {
        name: function (value) {
            value = (value || '').trim();
            if (value === '') return 'Nama Keperluan wajib diisi.';
            if (value.length < 3) return 'Nama Keperluan minimal 3 karakter.';
            if (value.length > 100) return 'Nama Keperluan maksimal 100 karakter.';
            return null;
        },
    };

    function validateField(field) {
        if (!field) return true;
        const validator = validators[field.name];
        if (!validator) return true;
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
            if (!field) return;
            if (!validateField(field)) {
                isValid = false;
                if (!firstInvalid) firstInvalid = field;
            }
        });
        if (firstInvalid) firstInvalid.focus();
        return isValid;
    }


    // CREATE MODAL
    const createModal = document.getElementById('createVisitPurposeModal');

    if (createModal) {
        const hasCreateErrors = createModal.dataset.createError === '1';
        if (hasCreateErrors) {
            bootstrap.Modal.getOrCreateInstance(createModal).show();
        }

        const createForm = createModal.querySelector('form');
        if (createForm) {

            createModal.addEventListener('show.bs.modal', function (event) {
                if (event.relatedTarget) {
                    resetForm(createForm);
                }
            });

            createForm.addEventListener('submit', function (event) {
                clearAllErrors(createForm);
                if (!validateForm(createForm, ['name'])) event.preventDefault();
            });

            createForm.querySelectorAll('[name]').forEach(function (field) {
                field.addEventListener('input', function () {
                    clearFieldError(field);
                });
            });

            createModal.addEventListener('hidden.bs.modal', function () {
                if (createModal.dataset.createError === '1') {
                    createModal.dataset.createError = '0';
                    return;
                }
                resetForm(createForm);
            });
        }
    }

    // EDIT MODAL
    const editModal = document.getElementById('editVisitPurposeModal');
    const editForm = document.getElementById('editVisitPurposeForm');

    if (editModal && editForm) {

        editModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            if (button) {

                resetForm(editForm);

                const purposeId = button.dataset.purposeId;
                if (!purposeId) return;

                editForm.querySelector('[name="name"]').value = button.dataset.purposeName || '';
                editForm.action = baseUrl + 'admin/visit-purposes/update/' + purposeId;

                editModal.dataset.editError = '0';

                return;
            }

            const editId = editModal.dataset.editPurposeId || '';
            if (!editId) return;

            editForm.action = baseUrl + 'admin/visit-purposes/update/' + editId;
        });

        editForm.addEventListener('submit', function (event) {
            clearAllErrors(editForm);
            if (!validateForm(editForm, ['name'])) event.preventDefault();
        });

        editForm.querySelectorAll('[name]').forEach(function (field) {
            field.addEventListener('input', function () {
                clearFieldError(field);
            });
        });

        if (editModal.dataset.editError === '1') {
            setTimeout(function () {
                bootstrap.Modal.getOrCreateInstance(editModal).show();
            }, 100);
        }

        editModal.addEventListener('hidden.bs.modal', function () {

            if (editModal.dataset.editError === '1') {
                editForm.action = '';
                editModal.dataset.editError = '0';
                return;
            }

            resetForm(editForm);
            editForm.action = '';
        });
    }


    // DELETE MODAL
    const deleteModal = document.getElementById('deleteVisitPurposeModal');
    const deleteForm = document.getElementById('deleteVisitPurposeForm');

    if (deleteModal && deleteForm) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const purposeId = button.dataset.purposeId;
            if (!purposeId) return;

            document.getElementById('delete_purpose_name').textContent = button.dataset.purposeName || '-';
            deleteForm.action = baseUrl + 'admin/visit-purposes/delete/' + purposeId;
        });

        deleteModal.addEventListener('hidden.bs.modal', function () {
            deleteForm.action = '';
        });
    }


    // TOGGLE MODAL
    const toggleModal = document.getElementById('toggleVisitPurposeModal');
    const toggleForm = document.getElementById('toggleVisitPurposeForm');

    if (toggleModal && toggleForm) {
        toggleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const purposeId = button.dataset.purposeId;
            const isActive = button.dataset.isActive === '1';
            const statusLabel = button.dataset.statusLabel || '-';

            if (!purposeId) return;

            document.getElementById('toggle_purpose_name').textContent = button.dataset.purposeName || '-';

            const statusEl = document.getElementById('toggle_purpose_current_status');
            statusEl.innerHTML = '';
            const badge = document.createElement('span');
            badge.className = 'app-badge ' + (isActive ? 'app-badge-active' : 'app-badge-inactive');
            badge.textContent = statusLabel;
            statusEl.appendChild(badge);

            const iconEl = document.getElementById('toggle_purpose_icon');
            if (iconEl) iconEl.className = isActive ? 'bi bi-toggle-on' : 'bi bi-toggle-off';

            const descEl = document.getElementById('toggle_purpose_description');
            if (descEl) descEl.textContent = isActive ? 'Nonaktifkan keperluan ini?' : 'Aktifkan keperluan ini?';

            const noteText = document.getElementById('toggle_purpose_note_text');
            if (noteText) {
                noteText.textContent = isActive
                    ? 'Keperluan tidak akan muncul di pilihan keperluan kunjungan.'
                    : 'Keperluan akan muncul kembali di pilihan keperluan kunjungan.';
            }

            const submitButton = document.getElementById('toggle_purpose_submit');
            if (submitButton) {
                submitButton.classList.toggle('app-btn-primary', !isActive);
                submitButton.classList.toggle('app-btn-danger', isActive);
                submitButton.innerHTML = isActive
                    ? '<i class="bi bi-toggle-off"></i> Nonaktifkan'
                    : '<i class="bi bi-toggle-on"></i> Aktifkan';
            }

            toggleForm.action = baseUrl + 'admin/visit-purposes/toggle-status/' + purposeId;
        });

        toggleModal.addEventListener('hidden.bs.modal', function () {
            toggleForm.action = '';
        });
    }


    // RESTORE MODAL
    const restoreModal = document.getElementById('restoreVisitPurposeModal');
    const restoreForm = document.getElementById('restoreVisitPurposeForm');

    if (restoreModal && restoreForm) {
        restoreModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const purposeId = button.dataset.purposeId;
            if (!purposeId) return;

            document.getElementById('restore_purpose_name').textContent = button.dataset.purposeName || '-';
            restoreForm.action = baseUrl + 'admin/visit-purposes/restore/' + purposeId;
        });

        restoreModal.addEventListener('hidden.bs.modal', function () {
            restoreForm.action = '';
        });
    }

});