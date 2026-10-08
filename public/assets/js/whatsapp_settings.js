document.addEventListener('DOMContentLoaded', function () {

    const editModal = document.getElementById('editWhatsappSettingsModal');

    if (!editModal) return;

    const editForm = editModal.querySelector('form');

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

        // ===== TEST WHATSAPP MODAL =====
    const testModal = document.getElementById('testWhatsappModal');

    if (testModal) {
        const hasTestError = testModal.dataset.testError === '1';

        if (hasTestError) {
            bootstrap.Modal.getOrCreateInstance(testModal).show();
        }

        testModal.addEventListener('show.bs.modal', function () {
            testModal.dataset.testError = '0';
        });
    }

});