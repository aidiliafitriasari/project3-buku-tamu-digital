document.addEventListener('DOMContentLoaded', function () {

    const wrapper = document.getElementById('guestSignature');

    if (!wrapper) {
        return;
    }

    const canvas = document.getElementById('guestSignatureCanvas');
    const btnClear = document.getElementById('guestSignatureClear');
    const btnReset = document.getElementById('guestSignatureReset');

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext('2d');

    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;
    let hasDrawn = false;
    let isSetup = false;

    let strokes = [];
    let currentStroke = null;

    function setupCanvas() {
        const rect = canvas.getBoundingClientRect();

        if (rect.width === 0 || rect.height === 0) {
            isSetup = false;
            return false;
        }

        const ratio = window.devicePixelRatio || 1;

        canvas.width = rect.width * ratio;
        canvas.height = rect.height * ratio;

        ctx.setTransform(1, 0, 0, 1, 0, 0);
        ctx.scale(ratio, ratio);

        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.strokeStyle = '#1b2e26';

        isSetup = true;

        redrawAll();

        return true;
    }

    function ensureCanvas() {
        const rect = canvas.getBoundingClientRect();

        if (
            !isSetup ||
            rect.width === 0 ||
            rect.height === 0 ||
            canvas.width !== rect.width * (window.devicePixelRatio || 1) ||
            canvas.height !== rect.height * (window.devicePixelRatio || 1)
        ) {
            return setupCanvas();
        }

        return true;
    }

    const step5 = document.querySelector('.guest-step[data-step="5"]');

    if (step5) {
        const observer = new MutationObserver(function () {
            if (step5.classList.contains('is-active')) {
                setTimeout(function () {
                    setupCanvas();
                }, 100);
            }
        });

        observer.observe(step5, {
            attributes: true,
            attributeFilter: ['class'],
        });
    }

    let resizeTimer = null;

    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(function () {
            if (!isSetup) {
                return;
            }

            setupCanvas();
        }, 200);
    });

    function getPosition(e) {
        const rect = canvas.getBoundingClientRect();

        let clientX, clientY;

        if (e.touches && e.touches.length > 0) {
            clientX = e.touches[0].clientX;
            clientY = e.touches[0].clientY;
        } else if (e.changedTouches && e.changedTouches.length > 0) {
            clientX = e.changedTouches[0].clientX;
            clientY = e.changedTouches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }

        return {
            x: clientX - rect.left,
            y: clientY - rect.top,
        };
    }

    function startDrawing(e) {
        if (!ensureCanvas()) {
            return;
        }

        e.preventDefault();
        isDrawing = true;

        const pos = getPosition(e);

        lastX = pos.x;
        lastY = pos.y;

        currentStroke = {
            points: [{ x: pos.x, y: pos.y }],
        };

        strokes.push(currentStroke);
    }

    function draw(e) {
        if (!isDrawing) {
            return;
        }

        e.preventDefault();

        const pos = getPosition(e);

        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();

        lastX = pos.x;
        lastY = pos.y;

        if (currentStroke) {
            currentStroke.points.push({ x: pos.x, y: pos.y });
        }

        if (!hasDrawn) {
            hasDrawn = true;
            notifyChange();
        }
    }

    function stopDrawing() {
        isDrawing = false;
        currentStroke = null;
    }

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseleave', stopDrawing);

    canvas.addEventListener('touchstart', startDrawing, { passive: false });
    canvas.addEventListener('touchmove', draw, { passive: false });
    canvas.addEventListener('touchend', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    function redrawAll() {
        if (canvas.width === 0 || canvas.height === 0) {
            return;
        }

        const ratio = window.devicePixelRatio || 1;

        ctx.clearRect(0, 0, canvas.width / ratio, canvas.height / ratio);

        strokes.forEach(function (stroke) {
            if (stroke.points.length < 1) {
                return;
            }

            ctx.beginPath();
            ctx.moveTo(stroke.points[0].x, stroke.points[0].y);

            for (let i = 1; i < stroke.points.length; i++) {
                ctx.lineTo(stroke.points[i].x, stroke.points[i].y);
            }

            ctx.stroke();
        });

        const wasDrawn = hasDrawn;
        hasDrawn = strokes.length > 0;

        if (wasDrawn !== hasDrawn) {
            notifyChange();
        }
    }

    function clearCanvas() {
        strokes = [];
        currentStroke = null;
        hasDrawn = false;

        if (canvas.width === 0 || canvas.height === 0) {
            notifyChange();
            return;
        }

        const ratio = window.devicePixelRatio || 1;

        ctx.clearRect(0, 0, canvas.width / ratio, canvas.height / ratio);

        notifyChange();
    }

    function undoLetters() {
        if (strokes.length === 0) {
            return;
        }

        strokes.pop();

        redrawAll();

        notifyChange();
    }

    function notifyChange() {
        const event = new CustomEvent('signature:changed', {
            detail: { hasSignature: hasDrawn },
        });

        canvas.dispatchEvent(event);
    }

    if (btnClear) {
        btnClear.addEventListener('click', undoLetters);
    }

    if (btnReset) {
        btnReset.addEventListener('click', clearCanvas);
    }

    window.guestSignature = {
        hasSignature: function () {
            return hasDrawn;
        },

        getBlob: function () {
            return new Promise(function (resolve, reject) {
                if (!hasDrawn) {
                    reject(new Error('Tanda tangan kosong.'));
                    return;
                }

                if (canvas.width === 0 || canvas.height === 0) {
                    setupCanvas();
                }

                if (canvas.width === 0 || canvas.height === 0) {
                    reject(new Error('Canvas tidak valid.'));
                    return;
                }

                const tempCanvas = document.createElement('canvas');
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;

                const tempCtx = tempCanvas.getContext('2d');

                tempCtx.fillStyle = '#ffffff';
                tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
                tempCtx.drawImage(canvas, 0, 0);

                tempCanvas.toBlob(function (blob) {
                    if (!blob || blob.size === 0) {
                        reject(new Error('Gagal generate blob.'));
                        return;
                    }

                    if (blob.size < 100) {
                        reject(new Error('Tanda tangan kosong.'));
                        return;
                    }

                    resolve(blob);
                }, 'image/png');
            });
        },

        clear: clearCanvas,
    };

    if (step5 && step5.classList.contains('is-active')) {
        setTimeout(setupCanvas, 100);
    }

});