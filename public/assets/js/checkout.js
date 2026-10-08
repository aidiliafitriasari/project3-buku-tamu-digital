document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    // SCAN QR — Halaman /petugas/checkout
    const readerEl = document.getElementById('checkoutScanReader');

    if (readerEl) {
        initScanner(baseUrl);
    }

    // KONFIRMASI CHECKOUT — Halaman /petugas/checkout/{token}
    const confirmBtn = document.getElementById('checkoutConfirmBtn');

    if (confirmBtn) {
        initConfirm(confirmBtn, baseUrl);
    }

    // Scanner
    function initScanner(baseUrl) {
        const btnStart = document.getElementById('checkoutScanStart');
        const btnStop  = document.getElementById('checkoutScanStop');
        const tokenInput = document.getElementById('checkoutScanToken');
        const btnSubmit = document.getElementById('checkoutScanSubmit');

        let html5QrCode = null;
        let isScanning = false;

        function startScan() {
            if (isScanning) {
                return;
            }

            html5QrCode = new Html5Qrcode('checkoutScanReader');

            readerEl.hidden = false;
            btnStart.hidden = true;
            btnStop.hidden = false;

            html5QrCode.start(
                { facingMode: 'environment' },
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                },
                function (decodedText) {
                    onScanSuccess(decodedText);
                },
                function (errorMessage) {

                }
            ).then(function () {
                isScanning = true;
            }).catch(function (err) {
                console.error('Scan error:', err);
                showToast('Kamera tidak dapat diakses. Silakan izinkan akses kamera atau gunakan input manual.', 'error', 6000);
                stopScan();
            });
        }

        function stopScan() {
            if (html5QrCode && isScanning) {
                html5QrCode.stop().then(function () {
                    html5QrCode.clear();
                    html5QrCode = null;
                    isScanning = false;

                    readerEl.hidden = true;
                    btnStart.hidden = false;
                    btnStop.hidden = true;
                }).catch(function (err) {
                    console.error('Stop error:', err);
                });
            } else {
                readerEl.hidden = true;
                btnStart.hidden = false;
                btnStop.hidden = true;
            }
        }

        function onScanSuccess(decodedText) {
            stopScan();

            const token = extractToken(decodedText);

            if (!token) {
                showToast('QR tidak valid. Token tidak ditemukan.', 'error');
                return;
            }

            redirectToCheckout(token);
        }

        function extractToken(text) {
            if (!text) {
                return null;
            }

            text = text.trim();

            if (text.indexOf('http') === 0) {
                try {
                    const url = new URL(text);
                    const parts = url.pathname.split('/').filter(Boolean);
                    return parts[parts.length - 1] || null;
                } catch (e) {
                    return null;
                }
            }

            return text;
        }

        function redirectToCheckout(token) {
            window.location.href = baseUrl + '/petugas/checkout/' + encodeURIComponent(token);
        }

        if (btnStart) {
            btnStart.addEventListener('click', startScan);
        }

        if (btnStop) {
            btnStop.addEventListener('click', stopScan);
        }

        if (btnSubmit && tokenInput) {
            btnSubmit.addEventListener('click', function () {
                const token = tokenInput.value.trim();

                if (!token) {
                    showToast('Token QR wajib diisi.', 'warning');
                    return;
                }

                redirectToCheckout(token);
            });

            tokenInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    btnSubmit.click();
                }
            });
        }
    }

    // Konfirmasi Checkout
    function initConfirm(confirmBtn, baseUrl) {
        confirmBtn.addEventListener('click', async function () {
            const token = confirmBtn.dataset.token;

            if (!token) {
                showToast('Token tidak valid.', 'error');
                return;
            }

            const confirmed = await showConfirm({
                title: 'Checkout Kunjungan',
                description: 'Konfirmasi checkout tamu.',
                message: 'Checkout kunjungan ini? Status akan berubah menjadi "Selesai".',
                confirmText: 'Checkout',
                confirmClass: 'app-btn-primary',
                icon: 'bi-box-arrow-right',
            });

            if (!confirmed) {
                return;
            }

            const originalText = confirmBtn.innerHTML;
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            fetch(baseUrl + '/petugas/checkout/' + encodeURIComponent(token), {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('HTTP error: ' + response.status);
                    }
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        document.getElementById('success_visit_code').textContent = data.data.visit_code;
                        document.getElementById('success_checkout_at').textContent = data.data.checkout_at;
                        document.getElementById('success_duration').textContent = data.data.duration;

                        const modal = new bootstrap.Modal(document.getElementById('checkoutSuccessModal'));
                        modal.show();
                    } else {
                        showToast(data.message || 'Checkout gagal.', 'error');
                        confirmBtn.disabled = false;
                        confirmBtn.innerHTML = originalText;
                    }
                })
                .catch(function (error) {
                    console.error('Checkout error:', error);
                    showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    confirmBtn.disabled = false;
                    confirmBtn.innerHTML = originalText;
                });
        });
    }

    // Helper
    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');

        if (meta) {
            return meta.getAttribute('content');
        }

        const match = document.cookie.match(/csrf_cookie_name=([^;]+)/);

        return match ? decodeURIComponent(match[1]) : '';
    }

});