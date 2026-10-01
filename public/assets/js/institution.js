document.addEventListener('DOMContentLoaded', function () {

    const editModal = document.getElementById('editInstitutionModal');

    if (!editModal) {
        return;
    }

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
    }


    // PREVIEW LOGO REAL-TIME
    const logoInput = document.getElementById('edit_logo');
    const logoPreview = document.getElementById('edit_logo_preview');

    if (logoInput && logoPreview) {

        logoInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                logoPreview.src = e.target.result;
                logoPreview.classList.remove('is-hidden');
            };

            reader.readAsDataURL(file);
        });
    }


    // AUTO SHOW MODAL KALAU VALIDASI GAGAL
    const hasEditErrors = editModal.dataset.editError === '1';

    if (hasEditErrors) {
        bootstrap.Modal.getOrCreateInstance(editModal).show();
    }


    // SAAT MODAL DIBUKA DARI TOMBOL
    editModal.addEventListener('show.bs.modal', function (event) {

        if (event.relatedTarget) {
           
            restoreOriginalValues(editForm);
            clearAllErrors(editForm);

            editModal.dataset.editError = '0';
        }
    });


    // ===== CLEANUP SAAT MODAL DITUTUP =====
    editModal.addEventListener('hidden.bs.modal', function () {

        if (editModal.dataset.editError === '1') {
            editModal.dataset.editError = '0';
            return;
        }

        if (logoInput) {
            logoInput.value = '';
        }

        if (logoPreview) {
            const originalSrc = logoPreview.dataset.originalSrc;

            if (originalSrc) {
                logoPreview.src = originalSrc;
                logoPreview.classList.remove('is-hidden');
            } else {
                logoPreview.src = '';
                logoPreview.classList.add('is-hidden');
            }
        }
    });

});