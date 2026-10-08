(function () {
    'use strict';

    let confirmModalEl = null;
    let confirmCallback = null;
    let cancelCallback = null;
    let isInitialized = false;

    function initModal() {
        if (isInitialized) {
            return;
        }

        confirmModalEl = document.getElementById('appConfirmModal');

        if (!confirmModalEl) {
            return;
        }

        isInitialized = true;

        const okBtn = document.getElementById('appConfirmOkBtn');
        const cancelBtn = document.getElementById('appConfirmCancelBtn');

        if (okBtn) {
            okBtn.addEventListener('click', function () {
                const modal = bootstrap.Modal.getInstance(confirmModalEl);

                if (modal) {
                    modal.hide();
                }

                if (typeof confirmCallback === 'function') {
                    confirmCallback();
                }

                // Reset
                confirmCallback = null;
                cancelCallback = null;
            });
        }

        // Cancel button — via tombol
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                if (typeof cancelCallback === 'function') {
                    cancelCallback();
                }

                // Reset
                confirmCallback = null;
                cancelCallback = null;
            });
        }

        // Cancel — via X atau klik backdrop
        confirmModalEl.addEventListener('hidden.bs.modal', function () {
            if (typeof cancelCallback === 'function') {
                cancelCallback();
            }

            // Reset
            confirmCallback = null;
            cancelCallback = null;
        });
    }

    window.showConfirm = function (options) {
        options = options || {};

        return new Promise(function (resolve) {
            // Fallback kalau modal tidak ada
            if (!document.getElementById('appConfirmModal')) {
                const fallbackMsg = options.message || 'Apakah Anda yakin?';
                resolve(window.confirm(fallbackMsg));
                return;
            }

            initModal();

            // Set title
            const titleEl = document.getElementById('appConfirmModalLabel');
            if (titleEl) {
                titleEl.textContent = options.title || 'Konfirmasi';
            }

            // Set description
            const descEl = document.getElementById('appConfirmDescription');
            if (descEl) {
                descEl.textContent = options.description || '';
                descEl.style.display = options.description ? '' : 'none';
            }

            // Set message
            const msgEl = document.getElementById('appConfirmMessage');
            if (msgEl) {
                msgEl.textContent = options.message || 'Apakah Anda yakin?';
            }

            // Set icon
            const iconWrapper = document.getElementById('appConfirmIcon');
            if (iconWrapper) {
                const iconClass = options.icon || 'bi-question-circle';
                iconWrapper.innerHTML = '<i class="bi ' + iconClass + '"></i>';
            }

            // Set tombol konfirmasi
            const okBtn = document.getElementById('appConfirmOkBtn');
            if (okBtn) {
                okBtn.className = 'app-btn ' + (options.confirmClass || 'app-btn-primary');
                okBtn.innerHTML = '<i class="bi bi-check-circle"></i> ' + (options.confirmText || 'Ya, Lanjutkan');
            }

            // Set tombol batal
            const cancelBtn = document.getElementById('appConfirmCancelBtn');
            if (cancelBtn) {
                cancelBtn.innerHTML = '<i class="bi bi-x-lg"></i> ' + (options.cancelText || 'Batal');
            }

            // Set callbacks
            confirmCallback = function () {
                resolve(true);
            };

            cancelCallback = function () {
                resolve(false);
            };

            const modal = new bootstrap.Modal(confirmModalEl);
            modal.show();
        });
    };

    document.addEventListener('DOMContentLoaded', function () {
        initModal();
    });
})();