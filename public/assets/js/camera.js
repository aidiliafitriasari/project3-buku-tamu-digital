document.addEventListener('DOMContentLoaded', function () {

    const cameraWrapper = document.getElementById('guestCamera');

    if (!cameraWrapper) {
        return;
    }

    const video = document.getElementById('guestCameraVideo');
    const photo = document.getElementById('guestCameraPhoto');
    const placeholder = document.getElementById('guestCameraPlaceholder');
    const errorBox = document.getElementById('guestCameraError');
    const fallbackBox = document.getElementById('guestCameraFallback');
    const fallbackInput = document.getElementById('photo_fallback');

    const btnStart = document.getElementById('guestCameraStart');
    const btnCapture = document.getElementById('guestCameraCapture');
    const btnRetake = document.getElementById('guestCameraRetake');
    const btnStop = document.getElementById('guestCameraStop');

    let stream = null;
    let capturedBlob = null;

    const form = document.getElementById('guestRegisterForm');
    const maxPhotoSizeKB = form
        ? parseInt(form.dataset.maxPhotoSize || '500', 10)
        : 500;

    async function startCamera() {
        try {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                throw new Error('getUserMedia not supported');
            }

            stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: 'user',
                    width: { ideal: 720 },
                    height: { ideal: 960 },
                },
                audio: false,
            });

            video.srcObject = stream;
            video.hidden = false;

            placeholder.hidden = true;
            errorBox.hidden = true;
            fallbackBox.hidden = true;

            btnStart.hidden = true;
            btnCapture.hidden = false;
            btnStop.hidden = false;
            btnRetake.hidden = true;

        } catch (err) {
            console.error('Camera error:', err);

            showCameraError();
        }
    }

    async function capturePhoto() {
        if (!stream) {
            return;
        }

        const canvas = document.createElement('canvas');
        const width = video.videoWidth;
        const height = video.videoHeight;

        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, width, height);

        const blob = await new Promise(function (resolve) {
            canvas.toBlob(resolve, 'image/jpeg', 0.85);
        });

        if (!blob) {
            showCameraError();
            return;
        }

        const compressed = await compressBlob(blob, maxPhotoSizeKB);

        capturedBlob = compressed;

        const previewUrl = URL.createObjectURL(compressed);
        photo.src = previewUrl;
        photo.hidden = false;
        video.hidden = true;

        btnCapture.hidden = true;
        btnRetake.hidden = false;
        btnStop.hidden = true;

        notifyChange();

        stopCamera();
    }

    function retakePhoto() {
        capturedBlob = null;

        photo.src = '';
        photo.hidden = true;

        if (photo.src) {
            URL.revokeObjectURL(photo.src);
        }

        notifyChange();

        startCamera();
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(function (track) {
                track.stop();
            });

            stream = null;
        }

        video.srcObject = null;
    }

    function showCameraError() {
        errorBox.hidden = false;
        fallbackBox.hidden = false;

        placeholder.hidden = true;
        video.hidden = true;
        photo.hidden = true;

        btnStart.hidden = true;
        btnCapture.hidden = true;
        btnRetake.hidden = true;
        btnStop.hidden = true;

        if (fallbackInput) {
            fallbackInput.disabled = false;
        }

        notifyChange();
    }

    async function compressBlob(blob, maxSizeKB) {
        const maxSizeBytes = maxSizeKB * 1024;

        if (blob.size <= maxSizeBytes) {
            return blob;
        }

        const img = await loadImage(blob);

        const canvas = document.createElement('canvas');
        let width = img.width;
        let height = img.height;

        const maxDim = 1200;

        if (width > maxDim || height > maxDim) {
            const ratio = Math.min(maxDim / width, maxDim / height);
            width = Math.round(width * ratio);
            height = Math.round(height * ratio);
        }

        canvas.width = width;
        canvas.height = height;

        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0, width, height);

        let quality = 0.85;
        let result = await canvasToBlob(canvas, quality);

        while (result.size > maxSizeBytes && quality > 0.3) {
            quality -= 0.1;
            result = await canvasToBlob(canvas, quality);
        }

        return result;
    }

    function loadImage(blob) {
        return new Promise(function (resolve, reject) {
            const img = new Image();
            const url = URL.createObjectURL(blob);

            img.onload = function () {
                URL.revokeObjectURL(url);
                resolve(img);
            };

            img.onerror = reject;
            img.src = url;
        });
    }

    function canvasToBlob(canvas, quality) {
        return new Promise(function (resolve) {
            canvas.toBlob(resolve, 'image/jpeg', quality);
        });
    }

    if (btnStart) {
        btnStart.addEventListener('click', startCamera);
    }

    if (btnCapture) {
        btnCapture.addEventListener('click', capturePhoto);
    }

    if (btnRetake) {
        btnRetake.addEventListener('click', retakePhoto);
    }

    if (btnStop) {
        btnStop.addEventListener('click', function () {
            stopCamera();

            video.hidden = true;
            placeholder.hidden = false;

            btnStart.hidden = false;
            btnCapture.hidden = true;
            btnRetake.hidden = true;
            btnStop.hidden = true;
        });
    }

    if (fallbackInput) {
        fallbackInput.addEventListener('change', function () {
            notifyChange();
        });
    }

    function notifyChange() {
        const event = new CustomEvent('photo:changed', {
            detail: { hasPhoto: capturedBlob !== null },
        });

        if (cameraWrapper) {
            cameraWrapper.dispatchEvent(event);
        }
    }

    window.guestCamera = {
        getBlob: function () {
            return capturedBlob;
        },
        hasPhoto: function () {
            return capturedBlob !== null;
        },
        getFallbackFile: function () {
            if (fallbackInput && fallbackInput.files && fallbackInput.files.length > 0) {
                return fallbackInput.files[0];
            }
            return null;
        },
    };

    document.querySelectorAll('[data-prev], [data-next]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (stream) {
                stopCamera();
            }
        });
    });

});