document.addEventListener('DOMContentLoaded', function () {

    const body = document.body;

    if (!body.classList.contains('kiosk-body')) {
        return;
    }

    const baseUrl = body.dataset.baseUrl || '';

    const IDLE_TIMEOUT = 2 * 60 * 1000;

    let idleTimer = null;

    function resetIdleTimer() {
        clearTimeout(idleTimer);

        idleTimer = setTimeout(function () {
            window.location.href = baseUrl + '/kiosk';
        }, IDLE_TIMEOUT);
    }

    function setupIdleTimeout() {
        const events = [
            'mousedown',
            'mousemove',
            'keypress',
            'scroll',
            'touchstart',
            'click',
        ];

        events.forEach(function (eventName) {
            document.addEventListener(eventName, resetIdleTimer, { passive: true });
        });

        resetIdleTimer();
    }

    const currentPath = window.location.pathname;

    const isSuccessPage =
        currentPath.indexOf('/kiosk/success') !== -1 ||
        currentPath.indexOf('/pendaftaran/sukses') !== -1;

    if (!isSuccessPage) {
        setupIdleTimeout();
    }

    const resetBtn = document.getElementById('kioskResetBtn');
    const countdownEl = document.getElementById('kioskCountdown');

    if (resetBtn || countdownEl) {
        let countdown = 30;

        const countdownTimer = setInterval(function () {
            countdown--;

            if (countdownEl) {
                countdownEl.textContent = countdown;
            }

            if (countdown <= 0) {
                clearInterval(countdownTimer);
                window.location.href = baseUrl + '/kiosk';
            }
        }, 1000);
    }

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            window.location.href = baseUrl + '/kiosk';
        });
    }

});