(function () {
    'use strict';

    function escapeHtml(text) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(String(text)));
        return div.innerHTML;
    }

    var TOAST_CONFIG = {
        success: {
            icon: 'bi-check-circle-fill',
            title: 'Berhasil',
            class: 'app-toast-success',
        },
        error: {
            icon: 'bi-x-circle-fill',
            title: 'Gagal',
            class: 'app-toast-error',
        },
        warning: {
            icon: 'bi-exclamation-triangle-fill',
            title: 'Peringatan',
            class: 'app-toast-warning',
        },
        info: {
            icon: 'bi-info-circle-fill',
            title: 'Informasi',
            class: 'app-toast-info',
        },
    };

    window.showToast = function (message, type, delay) {
        type = type || 'info';
        delay = (typeof delay === 'number') ? delay : 4000;

        var container = document.getElementById('appToastContainer');

        if (!container) {
            console.warn('Toast container tidak ditemukan. Fallback ke alert.');
            alert(message);
            return;
        }

        if (typeof bootstrap === 'undefined' || !bootstrap.Toast) {
            console.warn('Bootstrap Toast tidak tersedia. Fallback ke alert.');
            alert(message);
            return;
        }

        var config = TOAST_CONFIG[type] || TOAST_CONFIG.info;

        var toastEl = document.createElement('div');
        toastEl.className = 'toast app-toast ' + config.class;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        toastEl.setAttribute('data-bs-autohide', 'true');
        toastEl.setAttribute('data-bs-delay', String(delay));

        toastEl.innerHTML =
            '<div class="toast-header">' +
                '<i class="bi ' + config.icon + ' app-toast-icon"></i>' +
                '<strong class="me-auto app-toast-title">' + config.title + '</strong>' +
                '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Tutup"></button>' +
            '</div>' +
            '<div class="toast-body">' + escapeHtml(message) + '</div>';

        container.appendChild(toastEl);

        var toast = new bootstrap.Toast(toastEl);
        toast.show();

        toastEl.addEventListener('hidden.bs.toast', function () {
            toastEl.remove();
        });
    };

    window.queueToast = function (message, type) {
        try {
            sessionStorage.setItem('toast_message', String(message));
            sessionStorage.setItem('toast_type', String(type || 'info'));
        } catch (e) {
            console.warn('sessionStorage tidak tersedia.', e);
        }
    };

    document.addEventListener('DOMContentLoaded', function () {
        var message = null;
        var type = null;

        try {
            message = sessionStorage.getItem('toast_message');
            type = sessionStorage.getItem('toast_type');

            if (message) {
                sessionStorage.removeItem('toast_message');
                sessionStorage.removeItem('toast_type');
            }
        } catch (e) {

        }

        if (message) {
            setTimeout(function () {
                window.showToast(message, type || 'info');
            }, 300);
        }
    });
})();