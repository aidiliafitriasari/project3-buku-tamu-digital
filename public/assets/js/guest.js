document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('guestRegisterForm');

    if (!form) {
        return;
    }

    const baseUrl = document.body.dataset.baseUrl || '';

    const totalSteps = 5;
    let currentStep = 1;

    const progressFill = document.getElementById('guestProgressFill');
    const progressSteps = document.querySelectorAll('.guest-progress-step');
    const steps = document.querySelectorAll('.guest-step');

    const submitBtn = document.getElementById('guestSubmitBtn');

    let employeesData = [];

    try {
        employeesData = JSON.parse(form.dataset.employees || '[]');
    } catch (e) {
        employeesData = [];
    }

    function goToStep(step) {
        if (step < 1 || step > totalSteps) {
            return;
        }

        steps.forEach(function (el) {
            el.classList.toggle(
                'is-active',
                Number(el.dataset.step) === step
            );
        });

        progressSteps.forEach(function (el) {
            const elStep = Number(el.dataset.step);

            el.classList.toggle('is-active', elStep === step);
            el.classList.toggle('is-completed', elStep < step);
        });

        if (progressFill) {
            const percent = (step / totalSteps) * 100;
            progressFill.style.width = percent + '%';
        }

        currentStep = step;

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.querySelectorAll('[data-next]').forEach(function (btn) {
        btn.addEventListener('click', async function () {
            const nextStep = Number(btn.dataset.next);

            if (await validateStep(currentStep)) {
                goToStep(nextStep);
            }
        });
    });

    document.querySelectorAll('[data-prev]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const prevStep = Number(btn.dataset.prev);
            goToStep(prevStep);
        });
    });

    async function validateStep(step) {
        let isValid = true;

        clearAllErrors();

        switch (step) {
            case 1: isValid = validateStep1(); break;
            case 2: isValid = validateStep2(); break;
            case 3: isValid = validateStep3(); break;
            case 4: isValid = await validateStep4(); break;
            case 5: isValid = validateStep5(); break;
        }

        return isValid;
    }

    function validateStep1() {
        let isValid = true;

        const name = document.getElementById('name');
        const phone = document.getElementById('phone');
        const address = document.getElementById('address');
        const identityType = document.getElementById('identity_type');
        const identityNumber = document.getElementById('identity_number');
        const originInstitution = document.getElementById('origin_institution');

        if (!name.value.trim()) {
            showError('name', 'Nama lengkap wajib diisi.');
            isValid = false;
        } else if (name.value.trim().length < 3) {
            showError('name', 'Nama lengkap minimal 3 karakter.');
            isValid = false;
        }

        if (!phone.value.trim()) {
            showError('phone', 'Nomor HP wajib diisi.');
            isValid = false;
        } else if (!/^(\+62|62|0)8[1-9][0-9]{6,11}$/.test(phone.value.trim())) {
            showError('phone', 'Format nomor HP tidak valid. Contoh: 081234567890.');
            isValid = false;
        }

        if (!address.value.trim()) {
            showError('address', 'Alamat wajib diisi.');
            isValid = false;
        } else if (address.value.trim().length < 5) {
            showError('address', 'Alamat minimal 5 karakter.');
            isValid = false;
        }

        if (!identityType.value) {
            showError('identity_type', 'Jenis identitas wajib dipilih.');
            isValid = false;
        }

        if (!identityNumber.value.trim()) {
            showError('identity_number', 'Nomor identitas wajib diisi.');
            isValid = false;
        } else {
            const formatCheck = validateIdentityNumber(
                identityType.value,
                identityNumber.value.trim()
            );

            if (!formatCheck.valid) {
                showError('identity_number', formatCheck.message);
                isValid = false;
            }
        }

        if (!originInstitution.value.trim()) {
            showError('origin_institution', 'Asal instansi/perusahaan wajib diisi.');
            isValid = false;
        } else if (originInstitution.value.trim().length < 3) {
            showError('origin_institution', 'Asal instansi minimal 3 karakter.');
            isValid = false;
        }

        return isValid;
    }

    function validateStep2() {
        let isValid = true;

        const departmentId = document.getElementById('department_id');
        const employeeId = document.getElementById('employee_id');
        const visitPurposeId = document.getElementById('visit_purpose_id');
        const groupCount = document.getElementById('group_count');

        if (!departmentId.value) {
            showError('department_id', 'Departemen tujuan wajib dipilih.');
            isValid = false;
        }

        if (!employeeId.value) {
            showError('employee_id', 'Pegawai tujuan wajib dipilih.');
            isValid = false;
        }

        if (!visitPurposeId.value) {
            showError('visit_purpose_id', 'Keperluan kunjungan wajib dipilih.');
            isValid = false;
        }

        const groupCountValue = parseInt(groupCount.value, 10);

        if (!groupCount.value || isNaN(groupCountValue) || groupCountValue < 1) {
            showError('group_count', 'Jumlah rombongan minimal 1 orang.');
            isValid = false;
        }

        return isValid;
    }

    function validateStep3() {
        const photoRequired = form.dataset.photoRequired === '1';

        if (!photoRequired) {
            return true;
        }

        const hasCameraPhoto = window.guestCamera && window.guestCamera.hasPhoto();
        const fallbackFile = window.guestCamera ? window.guestCamera.getFallbackFile() : null;

        if (!hasCameraPhoto && !fallbackFile) {
            showError('photo', 'Foto wajib diambil atau diupload.');
            return false;
        }

        return true;
    }

    async function validateStep4() {
        const signatureRequired = form.dataset.signatureRequired === '1';

        if (!signatureRequired) {
            return true;
        }

        const hasSignature = window.guestSignature && window.guestSignature.hasSignature();

        if (!hasSignature) {
            showError('signature', 'Tanda tangan wajib diisi.');
            return false;
        }

        try {
            const blob = await window.guestSignature.getBlob();

            if (!blob || blob.size < 100) {
                showError('signature', 'Tanda tangan kosong. Silakan gambar ulang.');
                return false;
            }
        } catch (e) {
            showError('signature', 'Tanda tangan kosong. Silakan gambar ulang.');
            return false;
        }

        return true;
    }

    function validateStep5() {
        const consent = document.getElementById('data_consent');

        if (!consent.checked) {
            showError('data_consent', 'Anda harus menyetujui penggunaan data.');
            return false;
        }

        return true;
    }

    function validateIdentityNumber(type, value) {
        switch (type) {
            case 'ktp':
                if (!/^\d{16}$/.test(value)) {
                    return { valid: false, message: 'Nomor KTP harus 16 digit angka.' };
                }
                break;

            case 'sim':
                if (!/^\d{12,16}$/.test(value)) {
                    return { valid: false, message: 'Nomor SIM harus 12-16 digit angka.' };
                }
                break;

            case 'paspor':
                if (!/^[A-Z0-9]{6,12}$/i.test(value)) {
                    return { valid: false, message: 'Nomor Paspor harus 6-12 karakter huruf/angka.' };
                }
                break;

            case 'kartu_pelajar':
            case 'kartu_mahasiswa':
            case 'lainnya':
                if (value.length < 3) {
                    return { valid: false, message: 'Nomor identitas minimal 3 karakter.' };
                }
                break;
        }

        return { valid: true, message: '' };
    }

    function showError(fieldName, message) {
        const errorEl = document.querySelector(`[data-error-for="${fieldName}"]`);
        const inputEl = document.getElementById(fieldName);

        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.add('is-visible');
        }

        if (inputEl) {
            inputEl.classList.add('is-invalid');
        }
    }

    function clearError(fieldName) {
        const errorEl = document.querySelector(`[data-error-for="${fieldName}"]`);

        if (errorEl) {
            errorEl.textContent = '';
            errorEl.classList.remove('is-visible');
        }

        const inputEl = document.getElementById(fieldName);

        if (inputEl) {
            inputEl.classList.remove('is-invalid');
        }
    }

    function clearAllErrors() {
        document.querySelectorAll('.guest-form-error').forEach(function (el) {
            el.textContent = '';
            el.classList.remove('is-visible');
        });

        document.querySelectorAll('.guest-form-input, .guest-form-select, .guest-form-textarea').forEach(function (el) {
            el.classList.remove('is-invalid');
        });
    }

    const departmentSelect = document.getElementById('department_id');
    const employeeSelect = document.getElementById('employee_id');

    if (departmentSelect && employeeSelect) {
        departmentSelect.addEventListener('change', function () {
            const departmentId = Number(departmentSelect.value);

            employeeSelect.innerHTML = '<option value="">— Pilih Pegawai —</option>';

            if (!departmentId) {
                employeeSelect.disabled = true;
                employeeSelect.innerHTML = '<option value="">— Pilih Departemen Terlebih Dahulu —</option>';
                return;
            }

            const filtered = employeesData.filter(function (emp) {
                return Number(emp.department_id) === departmentId;
            });

            if (filtered.length === 0) {
                employeeSelect.disabled = true;
                employeeSelect.innerHTML = '<option value="">— Tidak Ada Pegawai —</option>';
                return;
            }

            employeeSelect.disabled = false;

            filtered.forEach(function (emp) {
                const option = document.createElement('option');
                option.value = emp.id;
                option.textContent = emp.name;
                employeeSelect.appendChild(option);
            });
        });
    }

    const identityTypeSelect = document.getElementById('identity_type');
    const identityNumberInput = document.getElementById('identity_number');
    const identityHelp = document.getElementById('identityHelp');

    const identityConfig = {
        ktp: { placeholder: 'Contoh: 3171012345678901', help: 'Nomor KTP: 16 digit angka.' },
        sim: { placeholder: 'Contoh: 123456789012', help: 'Nomor SIM: 12-16 digit angka.' },
        paspor: { placeholder: 'Contoh: A1234567', help: 'Nomor Paspor: 6-12 karakter huruf/angka.' },
        kartu_pelajar: { placeholder: 'Contoh: 2024001', help: 'Nomor Kartu Pelajar.' },
        kartu_mahasiswa: { placeholder: 'Contoh: 2024001001', help: 'Nomor Kartu Mahasiswa.' },
        lainnya: { placeholder: 'Contoh: KP-2024-001', help: 'Nomor identitas lainnya (contoh: Kartu Pegawai).' },
    };

    if (identityTypeSelect && identityNumberInput && identityHelp) {
        identityTypeSelect.addEventListener('change', function () {
            const type = identityTypeSelect.value;
            const config = identityConfig[type];

            if (config) {
                identityNumberInput.placeholder = config.placeholder;
                identityHelp.innerHTML = '<i class="bi bi-info-circle"></i> ' + config.help;
            } else {
                identityNumberInput.placeholder = 'Pilih jenis identitas terlebih dahulu';
                identityHelp.innerHTML = '<i class="bi bi-info-circle"></i> Format akan disesuaikan dengan jenis identitas.';
            }
        });
    }

    const signatureCanvas = document.getElementById('guestSignatureCanvas');

    if (signatureCanvas) {
        signatureCanvas.addEventListener('signature:changed', function (e) {
            if (e.detail.hasSignature) {
                clearError('signature');
            }
        });
    }

    const cameraWrapper = document.getElementById('guestCamera');

    if (cameraWrapper) {
        cameraWrapper.addEventListener('photo:changed', function (e) {
            if (e.detail.hasPhoto) {
                clearError('photo');
            }
        });
    }

    const realtimeFields = [
        'name',
        'phone',
        'address',
        'identity_type',
        'identity_number',
        'origin_institution',
        'department_id',
        'employee_id',
        'visit_purpose_id',
        'group_count',
    ];

    realtimeFields.forEach(function (fieldId) {
        const el = document.getElementById(fieldId);

        if (!el) {
            return;
        }

        const eventName = (el.tagName === 'SELECT') ? 'change' : 'input';

        el.addEventListener(eventName, function () {
            clearError(fieldId);
        });
    });

    const consentCheckbox = document.getElementById('data_consent');

    if (consentCheckbox) {
        consentCheckbox.addEventListener('change', function () {
            if (consentCheckbox.checked) {
                clearError('data_consent');
            }
        });
    }

    if (submitBtn) {
        submitBtn.addEventListener('click', async function (e) {
            e.preventDefault();

            if (!await validateStep(5)) {
                return;
            }

            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            try {
                const formData = new FormData(form);

                if (window.guestCamera && window.guestCamera.hasPhoto()) {
                    const photoBlob = window.guestCamera.getBlob();
                    const photoFile = new File([photoBlob], 'photo.jpg', { type: 'image/jpeg' });
                    formData.append('photo', photoFile);
                }

                if (window.guestCamera) {
                    const fallbackFile = window.guestCamera.getFallbackFile();
                    if (fallbackFile && !window.guestCamera.hasPhoto()) {
                        formData.append('photo', fallbackFile);
                    }
                }

                if (window.guestSignature && window.guestSignature.hasSignature()) {
                    try {
                        const signatureBlob = await window.guestSignature.getBlob();
                        const signatureFile = new File([signatureBlob], 'signature.png', { type: 'image/png' });
                        formData.append('signature', signatureFile);
                    } catch (err) {
                        console.error('Signature error:', err);
                        showToast('Tanda tangan kosong. Silakan gambar ulang.', 'error');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        return;
                    }
                }

                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (data.success && data.redirect) {
                    const successUrl = form.dataset.successUrl;

                    if (successUrl) {
                        const parts = data.redirect.split('/');
                        const token = parts[parts.length - 1];
                        window.location.href = successUrl + '/' + token;
                    } else {
                        window.location.href = data.redirect;
                    }
                    return;
                }

                if (data.errors && Object.keys(data.errors).length > 0) {
                    Object.keys(data.errors).forEach(function (field) {
                        showError(field, data.errors[field]);
                    });
                }

                showToast(data.message || 'Registrasi gagal. Silakan coba lagi.', 'error');

        } catch (err) {
            console.error('Submit error:', err);
            showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }
        });
    }

    goToStep(1);

    window.guestForm = {
        form: form,
        baseUrl: baseUrl,
    };

});