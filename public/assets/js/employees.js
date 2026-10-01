document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    const filterForm = document.getElementById('employeesFilterForm');
    const content = document.getElementById('employeesContent');
    const loading = document.getElementById('employeesLoading');

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
            if (value === '') return 'Nama Pegawai wajib diisi.';
            if (value.length < 3) return 'Nama Pegawai minimal 3 karakter.';
            if (value.length > 100) return 'Nama Pegawai maksimal 100 karakter.';
            return null;
        },

        department_id: function (value) {
            if (!value) return 'Bagian wajib dipilih.';
            return null;
        },

        nomor_hp: function (value) {
            value = (value || '').trim();
            if (value === '') return 'Nomor HP wajib diisi.';
            if (!/^(?:\+62|62|0)8[1-9][0-9]{7,11}$/.test(value)) {
                return 'Nomor HP harus menggunakan format nomor Indonesia yang valid.';
            }
            return null;
        },

        email: function (value) {
            value = (value || '').trim();
            if (value === '') return 'Email wajib diisi.';
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return 'Email harus menggunakan format email yang valid.';
            }
            if (value.length > 255) return 'Email maksimal 255 karakter.';
            return null;
        },
    };

    function validateField(field) {
        if (!field) return true;

        const name = field.name;
        const validator = validators[name];

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
    const createModal = document.getElementById('createEmployeeModal');

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

                const isValid = validateForm(createForm, [
                    'name',
                    'department_id',
                    'nomor_hp',
                    'email',
                ]);

                if (!isValid) event.preventDefault();
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
    const editModal = document.getElementById('editEmployeeModal');
    const editForm = document.getElementById('editEmployeeForm');

    if (editModal && editForm) {

        editModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;

            if (button) {

                resetForm(editForm);

                const employeeId = button.dataset.employeeId;
                if (!employeeId) return;

                editForm.querySelector('[name="name"]').value = button.dataset.name || '';
                editForm.querySelector('[name="department_id"]').value = button.dataset.departmentId || '';
                editForm.querySelector('[name="nomor_hp"]').value = button.dataset.nomorHp || '';
                editForm.querySelector('[name="email"]').value = button.dataset.email || '';

                editForm.action = baseUrl + 'admin/employees/update/' + employeeId;

                editModal.dataset.editError = '0';

                return;
            }

            const editEmployeeId = editModal.dataset.editEmployeeId || '';
            if (!editEmployeeId) return;

            editForm.action = baseUrl + 'admin/employees/update/' + editEmployeeId;
        });

        editForm.addEventListener('submit', function (event) {
            clearAllErrors(editForm);

            const isValid = validateForm(editForm, [
                'name',
                'department_id',
                'nomor_hp',
                'email',
            ]);

            if (!isValid) event.preventDefault();
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


    // DETAIL MODAL
    const detailModal = document.getElementById('detailEmployeeModal');

    if (detailModal) {

        detailModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;
            if (!button) return;

            document.getElementById('show_employee_name').textContent = button.dataset.name || '-';
            document.getElementById('show_employee_id').textContent = '#' + (button.dataset.employeeId || '-');
            document.getElementById('show_employee_department').textContent = button.dataset.department || '-';
            document.getElementById('show_employee_phone').textContent = button.dataset.nomorHp || '-';
            document.getElementById('show_employee_email').textContent = button.dataset.email || '-';

            const statusEl = document.getElementById('show_employee_status');
            const isActive = button.dataset.isActive === '1';

            statusEl.innerHTML = '';

            const badge = document.createElement('span');
            badge.className = 'app-badge ' + (isActive ? 'app-badge-active' : 'app-badge-inactive');
            badge.textContent = isActive ? 'Aktif' : 'Tidak Aktif';

            statusEl.appendChild(badge);
        });
    }


    // DELETE MODAL
    const deleteModal = document.getElementById('deleteEmployeeModal');
    const deleteForm = document.getElementById('deleteEmployeeForm');

    if (deleteModal && deleteForm) {

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const employeeId = button.dataset.employeeId;
            if (!employeeId) return;

            document.getElementById('delete_employee_name').textContent = button.dataset.employeeName || '-';

            deleteForm.action = baseUrl + 'admin/employees/delete/' + employeeId;
        });

        deleteModal.addEventListener('hidden.bs.modal', function () {
            deleteForm.action = '';
        });
    }


    // TOGGLE MODAL
    const toggleModal = document.getElementById('toggleEmployeeModal');
    const toggleForm = document.getElementById('toggleEmployeeForm');

    if (toggleModal && toggleForm) {

        toggleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const employeeId = button.dataset.employeeId;
            const isActive = button.dataset.isActive === '1';
            const statusLabel = button.dataset.statusLabel || '-';

            if (!employeeId) return;

            document.getElementById('toggle_employee_name').textContent = button.dataset.employeeName || '-';

            const statusEl = document.getElementById('toggle_employee_current_status');
            statusEl.innerHTML = '';

            const badge = document.createElement('span');
            badge.className = 'app-badge ' + (isActive ? 'app-badge-active' : 'app-badge-inactive');
            badge.textContent = statusLabel;

            statusEl.appendChild(badge);

            const iconEl = document.getElementById('toggle_employee_icon');
            if (iconEl) {
                iconEl.className = isActive ? 'bi bi-toggle-on' : 'bi bi-toggle-off';
            }

            const descEl = document.getElementById('toggle_employee_description');
            if (descEl) {
                descEl.textContent = isActive ? 'Nonaktifkan pegawai ini?' : 'Aktifkan pegawai ini?';
            }

            const noteText = document.getElementById('toggle_employee_note_text');
            if (noteText) {
                noteText.textContent = isActive
                    ? 'Pegawai tidak akan muncul di pilihan tujuan kunjungan.'
                    : 'Pegawai akan muncul kembali di pilihan tujuan kunjungan.';
            }

            const submitButton = document.getElementById('toggle_employee_submit');
            if (submitButton) {
                submitButton.classList.toggle('app-btn-primary', !isActive);
                submitButton.classList.toggle('app-btn-danger', isActive);
                submitButton.innerHTML = isActive
                    ? '<i class="bi bi-toggle-off"></i> Nonaktifkan'
                    : '<i class="bi bi-toggle-on"></i> Aktifkan';
            }

            toggleForm.action = baseUrl + 'admin/employees/toggle-status/' + employeeId;
        });

        toggleModal.addEventListener('hidden.bs.modal', function () {
            toggleForm.action = '';
        });
    }


    // RESTORE MODAL
    const restoreModal = document.getElementById('restoreEmployeeModal');
    const restoreForm = document.getElementById('restoreEmployeeForm');

    if (restoreModal && restoreForm) {

        restoreModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const employeeId = button.dataset.employeeId;
            if (!employeeId) return;

            document.getElementById('restore_employee_name').textContent = button.dataset.employeeName || '-';

            restoreForm.action = baseUrl + 'admin/employees/restore/' + employeeId;
        });

        restoreModal.addEventListener('hidden.bs.modal', function () {
            restoreForm.action = '';
        });
    }

});