document.addEventListener('DOMContentLoaded', function () {

    const editModal = document.getElementById('editSettingsModal');

    if (!editModal) return;

    const editForm = editModal.querySelector('form');

    const colorPicker = document.getElementById('edit_primary_color');
    const colorText = document.getElementById('edit_primary_color_text');
    const colorPreview = document.getElementById('edit_color_preview');

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

    function restoreOriginalValues(form) {
        if (!form) return;

        form.querySelectorAll('[data-original-value]').forEach(function (field) {
            field.value = field.dataset.originalValue;
        });

        form.querySelectorAll('[data-original-checked]').forEach(function (field) {
            field.checked = field.dataset.originalChecked === '1';
        });

        syncColorPicker();
    }

    function syncColorPicker() {
        if (!colorPicker || !colorText) return;

        const textValue = colorText.value.trim();

        if (/^#[0-9A-Fa-f]{6}$/.test(textValue)) {
            colorPicker.value = textValue;
        }

        updateColorPreview();
    }

    function updateColorPreview() {
        if (!colorPreview || !colorText) return;

        const value = colorText.value.trim();

        if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
            colorPreview.style.background = value;
        }
    }

    function validateColorInput() {
        if (!colorText) return true;

        const value = colorText.value.trim();
        const hexRegex = /^#[0-9A-Fa-f]{6}$/;

        if (!hexRegex.test(value)) {
            showFieldError(colorText, 'Warna harus format HEX yang valid. Contoh: #00309F');
            return false;
        }

        clearFieldError(colorText);
        return true;
    }

    // SINKRONISASI COLOR PICKER & TEXT
    if (colorPicker && colorText) {

        colorPicker.addEventListener('input', function () {
            colorText.value = colorPicker.value;
            updateColorPreview();
            clearFieldError(colorText);
        });

        colorText.addEventListener('input', function () {
            const value = colorText.value.trim();

            if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
                colorPicker.value = value;
                updateColorPreview();
                clearFieldError(colorText);
            }
        });
    }

    // VALIDASI SUBMIT
    if (editForm) {
        editForm.addEventListener('submit', function (event) {
            clearAllErrors(editForm);

            if (!validateColorInput()) {
                event.preventDefault();
            }
        });
    }

    // AUTO SHOW MODAL KALAU VALIDASI GAGAL
    const hasEditErrors = editModal.dataset.editError === '1';

    if (hasEditErrors) {
        bootstrap.Modal.getOrCreateInstance(editModal).show();
    }

    editModal.addEventListener('show.bs.modal', function (event) {

        if (event.relatedTarget) {
            restoreOriginalValues(editForm);
            clearAllErrors(editForm);
            editModal.dataset.editError = '0';
        }
    });

    editModal.addEventListener('hidden.bs.modal', function () {

        if (editModal.dataset.editError === '1') {
            editModal.dataset.editError = '0';
            return;
        }

        restoreOriginalValues(editForm);
        clearAllErrors(editForm);
    });

    updateColorPreview();

});