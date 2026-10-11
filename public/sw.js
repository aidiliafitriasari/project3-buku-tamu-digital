const CACHE_VERSION = 'buku-tamu-v2';
const PRECACHE_URLS = [
    '/offline.html',
    '/manifest.json',
    '/assets/css/tokens.css',
    '/assets/css/app.css',
    '/assets/css/panel.css',
    '/assets/css/components.css',
    '/assets/css/guest.css',
    '/assets/css/kiosk.css',
    '/assets/js/app.js',
    '/assets/js/panel.js',
    '/assets/js/toast.js',
    '/assets/js/confirm.js',
    '/assets/js/pwa.js',
    '/assets/icons/icon-192.png',
    '/assets/icons/icon-512.png',
    '/assets/icons/apple-touch-icon.png',
    '/assets/icons/favicon-32x32.png',
    '/assets/icons/favicon-16x16.png',
];

// INSTALL
self.addEventListener('install', (event) => {
    console.log('[SW] Installing...');

    event.waitUntil(
        caches.open(CACHE_VERSION)
            .then((cache) => {
                console.log('[SW] Precaching aset statis');
                return cache.addAll(PRECACHE_URLS);
            })
            .then(() => {
                console.log('[SW] Install selesai');
                return self.skipWaiting();
            })
    );
});

// ACTIVATE — Hapus cache lama
self.addEventListener('activate', (event) => {
    console.log('[SW] Activating...');

    event.waitUntil(
        caches.keys()
            .then((cacheNames) => {
                return Promise.all(
                    cacheNames
                        .filter((name) => name !== CACHE_VERSION)
                        .map((name) => {
                            console.log('[SW] Hapus cache lama:', name);
                            return caches.delete(name);
                        })
                );
            })
            .then(() => {
                console.log('[SW] Activate selesai');
                return self.clients.claim();
            })
    );
});

// FETCH — Strategi cache
self.addEventListener('fetch', (event) => {
    const request = event.request;
    const url = new URL(request.url);

    if (request.method !== 'GET') {
        return;
    }

    if (url.origin !== location.origin) {
        return;
    }

    if (url.pathname.startsWith('/uploads/') ||
        url.pathname.includes('/photo/') ||
        url.pathname.includes('/signature/')) {
        return;
    }

    if (url.pathname.includes('/partial') ||
        url.pathname.includes('/export') ||
        url.pathname.includes('/print') ||
        url.pathname.includes('/test')) {
        return;
    }

    if (url.pathname.startsWith('/assets/')) {
        event.respondWith(
            caches.match(request)
                .then((cached) => {
                    if (cached) {
                        return cached;
                    }

                    return fetch(request).then((response) => {
                        if (response && response.status === 200) {
                            const clone = response.clone();
                            caches.open(CACHE_VERSION).then((cache) => {
                                cache.put(request, clone);
                            });
                        }
                        return response;
                    });
                })
                .catch(() => {
                    return caches.match('/offline.html');
                })
        );
        return;
    }

        // HALAMAN HTML
    event.respondWith(
        fetch(request)
            .then((response) => {
                if (response && response.status === 200) {
                    if (url.pathname === '/' ||
                        url.pathname === '/pendaftaran' ||
                        url.pathname === '/kiosk') {
                        const clone = response.clone();
                        caches.open(CACHE_VERSION).then((cache) => {
                            cache.put(request, clone);
                        });
                    }
                }
                return response;
            })
            .catch(() => {
                return caches.match(request)
                    .then((cached) => {
                        if (cached) {
                            return cached;
                        }

                        var acceptHeader = request.headers.get('accept') || '';
                        var isHtmlRequest = acceptHeader.includes('text/html');
                        var isApiRequest = acceptHeader.includes('application/json') ||
                                          request.headers.get('x-requested-with') === 'XMLHttpRequest';

                        if (isApiRequest && !isHtmlRequest) {
                            return new Response(
                                JSON.stringify({
                                    success: false,
                                    message: 'Anda sedang offline.',
                                    offline: true
                                }),
                                {
                                    status: 503,
                                    statusText: 'Offline',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    }
                                }
                            );
                        }

                        return caches.match('/offline.html');
                    });
            })
    );
});