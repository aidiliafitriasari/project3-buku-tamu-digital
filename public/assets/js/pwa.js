(function () {
    'use strict';

    // SERVICE WORKER REGISTRATION
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker
                .register('/sw.js', { scope: '/' })
                .then(function (registration) {
                    console.log('[PWA] Service Worker terdaftar:', registration.scope);
                })
                .catch(function (error) {
                    console.warn('[PWA] Service Worker gagal:', error);
                });
        });
    }

    // INDIKATOR KONEKSI — Badge + Toast
    var connectionBadgeId = 'pwaConnectionBadge';
    var toastTimeout = null;

    function createConnectionBadge() {

        var navbar = document.querySelector('.navbar-actions');

        if (!navbar) {
            return null;
        }

        var existing = document.getElementById(connectionBadgeId);
        if (existing) {
            return existing;
        }

        var badge = document.createElement('div');
        badge.id = connectionBadgeId;
        badge.className = 'pwa-connection-badge';
        badge.setAttribute('title', 'Status koneksi');

        navbar.insertBefore(badge, navbar.firstChild);

        return badge;
    }

    function updateConnectionBadge() {
        var badge = document.getElementById(connectionBadgeId) || createConnectionBadge();

        if (!badge) {
            return;
        }

        var isOnline = navigator.onLine;

        badge.classList.toggle('is-online', isOnline);
        badge.classList.toggle('is-offline', !isOnline);

        badge.innerHTML = isOnline
            ? '<span class="pwa-badge-dot"></span><span class="pwa-badge-text">Online</span>'
            : '<span class="pwa-badge-dot"></span><span class="pwa-badge-text">Offline</span>';
    }

    function showConnectionToast(isOnline) {
        if (typeof window.showToast === 'function') {
            window.showToast(
                isOnline ? 'Koneksi kembali' : 'Anda sedang offline',
                isOnline ? 'success' : 'warning',
                3000
            );
            return;
        }

        var toast = document.getElementById('pwaConnectionToast');

        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'pwaConnectionToast';
            toast.className = 'pwa-connection-toast';
            document.body.appendChild(toast);
        }

        toast.textContent = isOnline
            ? '✅ Koneksi kembali'
            : '⚠️ Anda sedang offline';

        toast.classList.toggle('is-online', isOnline);
        toast.classList.toggle('is-offline', !isOnline);
        toast.classList.add('is-visible');

        clearTimeout(toastTimeout);

        toastTimeout = setTimeout(function () {
            toast.classList.remove('is-visible');
        }, 3000);
    }

    // EVENT LISTENERS
    window.addEventListener('online', function () {
        console.log('[PWA] Online');
        updateConnectionBadge();
        showConnectionToast(true);
    });

    window.addEventListener('offline', function () {
        console.log('[PWA] Offline');
        updateConnectionBadge();
        showConnectionToast(false);
    });

    // HANDLE SUBMIT SAAT OFFLINE
    document.addEventListener('submit', function (event) {
        if (!navigator.onLine) {
            event.preventDefault();
            event.stopImmediatePropagation();

            showConnectionToast(false);

            console.warn('[PWA] Submit diblokir — Anda sedang offline');
        }
    }, true);

        function updateSubmitButtons() {
        var isOnline = navigator.onLine;

        var submitButtons = document.querySelectorAll(
            'button[type="submit"], input[type="submit"]'
        );

        submitButtons.forEach(function (btn) {
            if (btn.dataset.pwaOriginalDisabled === 'true') {
                return;
            }

            if (btn.dataset.pwaInitialized !== 'true') {
                btn.dataset.pwaOriginalDisabled = btn.disabled ? 'true' : 'false';
                btn.dataset.pwaInitialized = 'true';
            }

            if (!isOnline) {
                if (btn.dataset.pwaOfflineDisabled !== 'true') {
                    btn.dataset.pwaPrevDisabled = btn.disabled ? 'true' : 'false';

                    btn.disabled = true;
                    btn.dataset.pwaOfflineDisabled = 'true';
                    btn.title = 'Tidak dapat submit saat offline';
                    btn.style.opacity = '0.5';
                    btn.style.cursor = 'not-allowed';
                }
            } else {
                if (btn.dataset.pwaOfflineDisabled === 'true') {
                    btn.disabled = btn.dataset.pwaPrevDisabled === 'true';
                    btn.dataset.pwaOfflineDisabled = 'false';
                    btn.removeAttribute('title');
                    btn.style.opacity = '';
                    btn.style.cursor = '';
                }
            }
        });
    }

    // EVENT LISTENERS
    window.addEventListener('online', updateSubmitButtons);
    window.addEventListener('offline', updateSubmitButtons);

    var observer = new MutationObserver(function (mutations) {
        var hasNewForm = mutations.some(function (mutation) {
            return Array.from(mutation.addedNodes).some(function (node) {
                return node.nodeType === 1 && (
                    node.tagName === 'FORM' ||
                    (node.querySelector && node.querySelector('form'))
                );
            });
        });

        if (hasNewForm) {
            updateSubmitButtons();
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // INIT
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(updateConnectionBadge, 100);

        setTimeout(updateSubmitButtons, 200);
    });

    window.addEventListener('load', function () {
        updateConnectionBadge();
        updateSubmitButtons();
    });

})();