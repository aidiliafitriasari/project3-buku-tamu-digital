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

                confirmCallback = null;
                cancelCallback = null;
            });
        }

        confirmModalEl.addEventListener('hidden.bs.modal', function () {
            if (typeof cancelCallback === 'function') {
                cancelCallback();
            }

            confirmCallback = null;
            cancelCallback = null;
        });
    }

    window.showConfirm = function (options) {
        options = options || {};

        return new Promise(function (resolve) {
            if (!document.getElementById('appConfirmModal')) {
                const fallbackMsg = options.message || 'Apakah Anda yakin?';
                resolve(window.confirm(fallbackMsg));
                return;
            }

            initModal();

            const titleEl = document.getElementById('appConfirmModalLabel');
            if (titleEl) {
                titleEl.textContent = options.title || 'Konfirmasi';
            }

            const descEl = document.getElementById('appConfirmDescription');
            if (descEl) {
                descEl.textContent = options.description || '';
                descEl.style.display = options.description ? '' : 'none';
            }

            const msgEl = document.getElementById('appConfirmMessage');
            if (msgEl) {
                msgEl.textContent = options.message || 'Apakah Anda yakin?';
            }

            const iconWrapper = document.getElementById('appConfirmIcon');
            if (iconWrapper) {
                const iconClass = options.icon || 'bi-question-circle';
                iconWrapper.innerHTML = '<i class="bi ' + iconClass + '"></i>';
            }

            const okBtn = document.getElementById('appConfirmOkBtn');
            if (okBtn) {
                okBtn.className = 'app-btn ' + (options.confirmClass || 'app-btn-primary');
                okBtn.innerHTML = '<i class="bi bi-check-circle"></i> ' + (options.confirmText || 'Ya, Lanjutkan');
            }

            const cancelBtn = document.getElementById('appConfirmCancelBtn');
            if (cancelBtn) {
                cancelBtn.innerHTML = '<i class="bi bi-x-lg"></i> ' + (options.cancelText || 'Batal');
            }

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