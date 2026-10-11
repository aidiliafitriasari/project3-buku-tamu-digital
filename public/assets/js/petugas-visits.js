document.addEventListener('DOMContentLoaded', function () {

    // HELPER
    function getBaseUrl() {
        return document.body.dataset.baseUrl || '';
    }

     // HELPER — Cek offline sebelum & sesudah fetch
    function handleOfflineError(fallbackMessage) {
        if (!navigator.onLine) {
            if (typeof window.showToast === 'function') {
                window.showToast('Anda sedang offline. Periksa koneksi internet Anda.', 'warning', 3000);
            }
            return 'Anda sedang offline. Periksa koneksi internet Anda.';
        }

        if (typeof window.showToast === 'function') {
            window.showToast(fallbackMessage || 'Terjadi kesalahan. Silakan coba lagi.', 'error', 3000);
        }

        return fallbackMessage || 'Terjadi kesalahan.';
    }

    function getBasePath() {
        const isAdmin = document.body.dataset.isAdmin === 'true';
        return isAdmin ? '/admin' : '/petugas';
    }

    function getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');

        if (meta) {
            return meta.getAttribute('content');
        }

        const match = document.cookie.match(/csrf_cookie_name=([^;]+)/);

        return match ? decodeURIComponent(match[1]) : '';
    }

    function setText(id, value) {
        const el = document.getElementById(id);

        if (el) {
            el.textContent = value || '-';
        }
    }

    function formatDateTime(dateStr) {
        if (!dateStr) {
            return '-';
        }

        const date = new Date(dateStr.replace(' ', 'T'));

        if (isNaN(date.getTime())) {
            return dateStr;
        }

        const options = {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        };

        return date.toLocaleDateString('id-ID', options);
    }

    function waitModalHidden(modalEl) {
        return new Promise(function (resolve) {
            if (!modalEl) {
                resolve();
                return;
            }

            const modal = bootstrap.Modal.getInstance(modalEl);

            if (!modal) {
                resolve();
                return;
            }

            if (!modalEl.classList.contains('show')) {
                resolve();
                return;
            }

            modalEl.addEventListener('hidden.bs.modal', function () {
                resolve();
            }, { once: true });
        });
    }

    // Buka modal
    function openModal(modalEl) {
        if (!modalEl) {
            return;
        }

        const modal = new bootstrap.Modal(modalEl);
        modal.show();
    }

    // MODAL VERIFY
    const verifyModal = document.getElementById('verifyVisitModal');

    if (verifyModal) {
        verifyModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            verifyModal.dataset.visitId = visitId;

            loadVerifyData(visitId);
        });
    }

    function loadVerifyData(visitId) {
        const loadingEl = document.getElementById('verifyLoading');
        const contentEl = document.getElementById('verifyContent');
        const errorEl = document.getElementById('verify_error');

        if (loadingEl) loadingEl.hidden = false;
        if (contentEl) contentEl.hidden = true;
        if (errorEl) errorEl.hidden = true;

        fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (!data.success) {
                    if (loadingEl) loadingEl.hidden = true;
                    if (errorEl) {
                        errorEl.hidden = false;
                        document.getElementById('verify_error_text').textContent = data.message || 'Gagal memuat data.';
                    }
                    return;
                }

                fillVerifyModal(data.visit);
                fillVerifyPhoto(data.visit);

                if (loadingEl) loadingEl.hidden = true;
                if (contentEl) contentEl.hidden = false;
            })
            .catch(function (error) {
                console.error('Fetch error:', error);

                if (loadingEl) loadingEl.hidden = true;
                if (errorEl) {
                    errorEl.hidden = false;

                    var message = !navigator.onLine
                        ? 'Anda sedang offline. Periksa koneksi internet Anda.'
                        : 'Gagal memuat data.';

                    document.getElementById('verify_error_text').textContent = message;
                }
            });
    }

    function fillVerifyModal(visit) {
        setText('verify_visit_code', visit.visit_code);
        setText('verify_origin_institution', visit.origin_institution);
        setText('verify_department_name', visit.department_name || '-');
        setText('verify_employee_name', visit.employee_name || '-');
        setText('verify_purpose_name', visit.purpose_name || '-');
        setText('verify_group_count', visit.group_count + ' orang');
        setText('verify_arrival_at', formatDateTime(visit.arrival_at));
        setText('verify_status', visit.status);
        setText('verify_guest_name', visit.guest_name);
        setText('verify_phone', visit.phone);
        setText('verify_address', visit.address);
        setText('verify_identity_type', visit.identity_type);
        setText('verify_identity_number', visit.identity_number);
    }

    function fillVerifyPhoto(visit) {
        const photoEl = document.getElementById('verify_photo');
        const photoEmpty = document.getElementById('verify_photo_empty');
        const sigEl = document.getElementById('verify_signature');
        const sigEmpty = document.getElementById('verify_signature_empty');

        if (visit.photo && photoEl) {
            photoEl.src = getBaseUrl() + '/' + visit.photo;
            photoEl.hidden = false;
            if (photoEmpty) photoEmpty.hidden = true;
        } else {
            if (photoEl) photoEl.hidden = true;
            if (photoEmpty) photoEmpty.hidden = false;
        }

        if (visit.signature && sigEl) {
            sigEl.src = getBaseUrl() + '/' + visit.signature;
            sigEl.hidden = false;
            if (sigEmpty) sigEmpty.hidden = true;
        } else {
            if (sigEl) sigEl.hidden = true;
            if (sigEmpty) sigEmpty.hidden = false;
        }
    }

    // CHECK-IN
    const checkinBtn = document.getElementById('verifyCheckinBtn');

    if (checkinBtn) {
        checkinBtn.addEventListener('click', async function () {
            const visitId = verifyModal ? verifyModal.dataset.visitId : null;

            if (!visitId) {
                return;
            }

            const visitCode = document.getElementById('verify_visit_code').textContent;

            const verifyInstance = bootstrap.Modal.getInstance(verifyModal);
            if (verifyInstance) {
                verifyInstance.hide();
            }

            await waitModalHidden(verifyModal);

            const confirmed = await showConfirm({
                title: 'Check-in Kunjungan',
                description: 'Konfirmasi check-in tamu.',
                message: 'Check-in kunjungan ' + visitCode + '?',
                confirmText: 'Check-in',
                confirmClass: 'app-btn-primary',
                icon: 'bi-check-circle',
            });

            if (!confirmed) {
                openModal(verifyModal);
                return;
            }

            checkinBtn.disabled = true;
            checkinBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/check-in', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(function (response) {
                    return response.json();
                })
               .then(function (data) {
                    if (data.success) {
                        queueToast('Check-in berhasil.', 'success');
                        window.location.reload();
                    } else {
                        showToast(data.message || 'Check-in gagal.', 'error');
                        checkinBtn.disabled = false;
                        checkinBtn.innerHTML = '<i class="bi bi-check-circle"></i> Check-in';
                    }
                })
                .catch(function (error) {
                    console.error('Check-in error:', error);
                    handleOfflineError('Gagal memproses check-in. Silakan coba lagi.');
                    checkinBtn.disabled = false;
                    checkinBtn.innerHTML = '<i class="bi bi-check-circle"></i> Check-in';
                });
        });
    }

    // REJECT
    const rejectModalEl = document.getElementById('rejectVisitModal');

    if (rejectModalEl) {
        rejectModalEl.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            if (!visitId) {
                return;
            }

            rejectModalEl.dataset.visitId = visitId;

            const visitCode = btn.dataset.visitCode || '';
            const guestName = btn.dataset.guestName || '';

            const reasonInput = document.getElementById('reject_reason');
            const reasonError = document.getElementById('reject_reason_error');

            if (reasonInput) {
                reasonInput.value = '';
                reasonInput.classList.remove('is-invalid');
            }

            if (reasonError) {
                reasonError.hidden = true;
                reasonError.textContent = '';
            }

            if (visitCode) {
                setText('reject_visit_code', visitCode);
            }

            if (guestName) {
                setText('reject_guest_name', guestName);
            }

            if (!visitCode) {
                const verifyCode = document.getElementById('verify_visit_code');
                const verifyName = document.getElementById('verify_guest_name');

                if (verifyCode) setText('reject_visit_code', verifyCode.textContent);
                if (verifyName) setText('reject_guest_name', verifyName.textContent);
            }
        });
    }

    const rejectReasonInput = document.getElementById('reject_reason');

    if (rejectReasonInput) {
        rejectReasonInput.addEventListener('input', function () {
            const reasonError = document.getElementById('reject_reason_error');

            if (reasonError && !reasonError.hidden) {
                reasonError.hidden = true;
                reasonError.textContent = '';
                rejectReasonInput.classList.remove('is-invalid');
            }
        });
    }

    const verifyRejectBtn = document.getElementById('verifyRejectBtn');

    if (verifyRejectBtn) {
        verifyRejectBtn.addEventListener('click', async function () {
            const visitId = verifyModal ? verifyModal.dataset.visitId : null;

            if (!visitId) {
                return;
            }

            const verifyInstance = bootstrap.Modal.getInstance(verifyModal);
            if (verifyInstance) {
                verifyInstance.hide();
            }

            await waitModalHidden(verifyModal);

            const rejectModal = document.getElementById('rejectVisitModal');

            if (rejectModal) {
                rejectModal.dataset.visitId = visitId;

                const visitCode = document.getElementById('verify_visit_code').textContent;
                const guestName = document.getElementById('verify_guest_name').textContent;

                setText('reject_visit_code', visitCode);
                setText('reject_guest_name', guestName);

                const reasonInput = document.getElementById('reject_reason');
                const reasonError = document.getElementById('reject_reason_error');

                if (reasonInput) {
                    reasonInput.value = '';
                    reasonInput.classList.remove('is-invalid');
                }

                if (reasonError) {
                    reasonError.hidden = true;
                    reasonError.textContent = '';
                }

                openModal(rejectModal);
            }
        });
    }

    const rejectConfirmBtn = document.getElementById('rejectConfirmBtn');

    if (rejectConfirmBtn) {
        rejectConfirmBtn.addEventListener('click', function () {
            const reasonInput = document.getElementById('reject_reason');
            const reasonError = document.getElementById('reject_reason_error');
            const reason = reasonInput.value.trim();

            // Reset error
            if (reasonError) {
                reasonError.hidden = true;
                reasonError.textContent = '';
            }

            reasonInput.classList.remove('is-invalid');

            if (!reason) {
                if (reasonError) {
                    reasonError.hidden = false;
                    reasonError.textContent = 'Alasan penolakan wajib diisi.';
                }

                reasonInput.classList.add('is-invalid');
                reasonInput.focus();
                return;
            }

            const rejectModal = document.getElementById('rejectVisitModal');
            const visitId = rejectModal ? rejectModal.dataset.visitId : null;

            if (!visitId) {
                return;
            }

            rejectConfirmBtn.disabled = true;
            rejectConfirmBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            const formData = new FormData();
            formData.append('reason', reason);

            fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/reject', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: formData,
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        queueToast('Kunjungan berhasil ditolak.', 'success');
                        window.location.reload();
                    } else {
                        showToast(data.message || 'Gagal menolak kunjungan.', 'error');
                        rejectConfirmBtn.disabled = false;
                        rejectConfirmBtn.innerHTML = '<i class="bi bi-x-circle"></i> Tolak Kunjungan';
                    }
                })
                .catch(function (error) {
                    console.error('Reject error:', error);
                    handleOfflineError('Gagal menolak kunjungan. Silakan coba lagi.');
                    rejectConfirmBtn.disabled = false;
                    rejectConfirmBtn.innerHTML = '<i class="bi bi-x-circle"></i> Tolak Kunjungan';
                });
        });
    }

    // CANCEL
    const cancelModal = document.getElementById('cancelVisitModal');

    if (cancelModal) {
        cancelModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            setText('cancel_visit_code', btn.dataset.visitCode || '-');
            setText('cancel_guest_name', btn.dataset.guestName || '-');

            cancelModal.dataset.visitId = btn.dataset.visitId || '';
        });
    }

    const cancelConfirmBtn = document.getElementById('cancelConfirmBtn');

    if (cancelConfirmBtn) {
        cancelConfirmBtn.addEventListener('click', async function () {
            const visitId = cancelModal ? cancelModal.dataset.visitId : null;

            if (!visitId) {
                return;
            }

            const cancelInstance = bootstrap.Modal.getInstance(cancelModal);
            if (cancelInstance) {
                cancelInstance.hide();
            }

            await waitModalHidden(cancelModal);

            const confirmed = await showConfirm({
                title: 'Batalkan Kunjungan',
                description: 'Kunjungan akan dibatalkan.',
                message: 'Batalkan kunjungan ini?',
                confirmText: 'Batalkan',
                confirmClass: 'app-btn-danger',
                icon: 'bi-slash-circle',
            });

            if (!confirmed) {
                openModal(cancelModal);
                return;
            }

            cancelConfirmBtn.disabled = true;
            cancelConfirmBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/cancel', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        queueToast('Kunjungan berhasil dibatalkan.', 'success');
                        window.location.reload();
                    } else {
                        showToast(data.message || 'Gagal membatalkan kunjungan.', 'error');
                        cancelConfirmBtn.disabled = false;
                        cancelConfirmBtn.innerHTML = '<i class="bi bi-slash-circle"></i> Batalkan Kunjungan';
                    }
                })
                .catch(function (error) {
                    console.error('Cancel error:', error);
                    handleOfflineError('Gagal membatalkan kunjungan. Silakan coba lagi.');
                    cancelConfirmBtn.disabled = false;
                    cancelConfirmBtn.innerHTML = '<i class="bi bi-slash-circle"></i> Batalkan Kunjungan';
                });
        });
    }

    // CHECKOUT
    const checkoutModal = document.getElementById('checkoutVisitModal');

    if (checkoutModal) {
        checkoutModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            checkoutModal.dataset.visitId = visitId;

            loadCheckoutData(visitId);
        });
    }

    function loadCheckoutData(visitId) {
        const loadingEl = document.getElementById('checkoutLoading');
        const contentEl = document.getElementById('checkoutContent');

        if (loadingEl) loadingEl.hidden = false;
        if (contentEl) contentEl.hidden = true;

        fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/data', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (!data.success) {
                    showToast(data.message || 'Gagal memuat data.', 'error');
                    return;
                }

                const visit = data.visit;

                setText('checkout_visit_code', visit.visit_code);
                setText('checkout_guest_name', visit.guest_name);
                setText('checkout_department_name', visit.department_name || '-');
                setText('checkout_employee_name', visit.employee_name || '-');
                setText('checkout_checkin_at', formatDateTime(visit.checkin_at));
                setText('checkout_duration', data.duration ? data.duration.text : '-');
                setText('checkout_status', visit.status);

                if (loadingEl) loadingEl.hidden = true;
                if (contentEl) contentEl.hidden = false;
            })
            .catch(function (error) {
                console.error('Fetch error:', error);
                handleOfflineError('Gagal memuat data checkout.');
            });
    }

    const checkoutConfirmBtn = document.getElementById('checkoutConfirmBtn');

    if (checkoutConfirmBtn) {
        checkoutConfirmBtn.addEventListener('click', async function () {
            const visitId = checkoutModal ? checkoutModal.dataset.visitId : null;

            if (!visitId) {
                return;
            }

            const checkoutInstance = bootstrap.Modal.getInstance(checkoutModal);
            if (checkoutInstance) {
                checkoutInstance.hide();
            }

            await waitModalHidden(checkoutModal);

            const confirmed = await showConfirm({
                title: 'Checkout Kunjungan',
                description: 'Konfirmasi checkout tamu.',
                message: 'Checkout kunjungan ini? Status akan berubah menjadi "Selesai".',
                confirmText: 'Checkout',
                confirmClass: 'app-btn-primary',
                icon: 'bi-box-arrow-right',
            });

            if (!confirmed) {
                openModal(checkoutModal);
                return;
            }

            checkoutConfirmBtn.disabled = true;
            checkoutConfirmBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Memproses...';

            fetch(getBaseUrl() + getBasePath() + '/visits/' + visitId + '/checkout', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        queueToast('Checkout berhasil.', 'success');
                        window.location.reload();
                    } else {
                        showToast(data.message || 'Checkout gagal.', 'error');
                        checkoutConfirmBtn.disabled = false;
                        checkoutConfirmBtn.innerHTML = '<i class="bi bi-box-arrow-right"></i> Konfirmasi Checkout';
                    }
                })
                .catch(function (error) {
                    console.error('Checkout error:', error);
                    handleOfflineError('Gagal memproses checkout. Silakan coba lagi.');
                    checkoutConfirmBtn.disabled = false;
                    checkoutConfirmBtn.innerHTML = '<i class="bi bi-box-arrow-right"></i> Konfirmasi Checkout';
                });
        });
    }

    // EDIT
    const editModal = document.getElementById('editVisitModal');

    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            editModal.dataset.visitId = visitId;

            loadEditData(visitId);
        });
    }

    function loadEditData(visitId) {
        const loadingEl = document.getElementById('editLoading');
        const formEl = document.getElementById('editVisitForm');
        const errorEl = document.getElementById('editError');
        const submitBtn = document.getElementById('editSubmitBtn');

        if (loadingEl) loadingEl.hidden = false;
        if (formEl) formEl.hidden = true;
        if (errorEl) errorEl.hidden = true;
        if (submitBtn) submitBtn.disabled = true;

        document.querySelectorAll('[id^="edit_error_"]').forEach(function (el) {
            el.hidden = true;
            el.textContent = '';
        });

        const isAdmin = document.body.dataset.isAdmin === 'true';
        const basePath = isAdmin ? '/admin' : '/petugas';

        fetch(getBaseUrl() + basePath + '/visits/' + visitId + '/edit', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (!data.success) {
                    if (loadingEl) loadingEl.hidden = true;
                    if (errorEl) {
                        errorEl.hidden = false;
                        document.getElementById('editErrorText').textContent = data.message || 'Gagal memuat data.';
                    }
                    return;
                }

                fillEditForm(data);
                fillEditDropdowns(data);

                if (loadingEl) loadingEl.hidden = true;
                if (formEl) formEl.hidden = false;
                if (submitBtn) submitBtn.disabled = false;
            })
            .catch(function (error) {
                console.error('Edit fetch error:', error);

                if (loadingEl) loadingEl.hidden = true;
                if (errorEl) {
                    errorEl.hidden = false;

                    var message = !navigator.onLine
                        ? 'Anda sedang offline. Periksa koneksi internet Anda.'
                        : 'Gagal memuat data.';

                    document.getElementById('editErrorText').textContent = message;
                }
            });
    }

    function fillEditForm(data) {
        const visit = data.visit;

        setText('edit_visit_code', visit.visit_code);
        setText('edit_status', visit.status);
        setText('edit_arrival_at', formatDateTime(visit.arrival_at));
        setText('edit_checkin_at', formatDateTime(visit.checkin_at));
        setText('edit_checkout_at', formatDateTime(visit.checkout_at));
        setText('edit_duration', visit.duration ? formatDuration(visit.duration) : '-');

        const visitIdInput = document.getElementById('edit_visit_id');
        if (visitIdInput) visitIdInput.value = visit.id;

        // Data Tamu
        const nameInput = document.getElementById('edit_name');
        if (nameInput) nameInput.value = visit.guest_name || '';

        const phoneInput = document.getElementById('edit_phone');
        if (phoneInput) phoneInput.value = visit.phone || '';

        const addressInput = document.getElementById('edit_address');
        if (addressInput) addressInput.value = visit.address || '';

        const identityTypeInput = document.getElementById('edit_identity_type');
        if (identityTypeInput) identityTypeInput.value = visit.identity_type || '';

        const identityNumberInput = document.getElementById('edit_identity_number');
        if (identityNumberInput) identityNumberInput.value = visit.identity_number || '';

        // Data Kunjungan
        const originInput = document.getElementById('edit_origin_institution');
        if (originInput) originInput.value = visit.origin_institution || '';

        const groupCountInput = document.getElementById('edit_group_count');
        if (groupCountInput) groupCountInput.value = visit.group_count || 1;

        // Simpan selected values
        editModal.dataset.departmentId = visit.department_id;
        editModal.dataset.employeeId = visit.employee_id;
        editModal.dataset.purposeId = visit.visit_purpose_id;
    }

    function fillEditDropdowns(data) {
        // Departemen
        const deptSelect = document.getElementById('edit_department_id');
        if (deptSelect) {
            deptSelect.innerHTML = '<option value="">Pilih Departemen</option>';
            data.departments.forEach(function (dept) {
                const option = document.createElement('option');
                option.value = dept.id;
                option.textContent = dept.name;
                if (String(dept.id) === String(editModal.dataset.departmentId)) {
                    option.selected = true;
                }
                deptSelect.appendChild(option);
            });
        }

        // Pegawai — filter by departemen
        const empSelect = document.getElementById('edit_employee_id');
        if (empSelect) {
            const selectedDeptId = editModal.dataset.departmentId;
            empSelect.innerHTML = '<option value="">Pilih Pegawai</option>';

            data.employees
                .filter(function (emp) {
                    return String(emp.department_id) === String(selectedDeptId);
                })
                .forEach(function (emp) {
                    const option = document.createElement('option');
                    option.value = emp.id;
                    option.textContent = emp.name;
                    if (String(emp.id) === String(editModal.dataset.employeeId)) {
                        option.selected = true;
                    }
                    empSelect.appendChild(option);
                });
        }

        // Keperluan
        const purposeSelect = document.getElementById('edit_visit_purpose_id');
        if (purposeSelect) {
            purposeSelect.innerHTML = '<option value="">Pilih Keperluan</option>';
            data.purposes.forEach(function (purpose) {
                const option = document.createElement('option');
                option.value = purpose.id;
                option.textContent = purpose.name;
                if (String(purpose.id) === String(editModal.dataset.purposeId)) {
                    option.selected = true;
                }
                purposeSelect.appendChild(option);
            });
        }
    }

    const editDeptSelect = document.getElementById('edit_department_id');

    if (editDeptSelect) {
        editDeptSelect.addEventListener('change', function () {
            const deptId = this.value;
            const empSelect = document.getElementById('edit_employee_id');

            if (!empSelect) return;

            empSelect.innerHTML = '<option value="">Memuat pegawai...</option>';

            const isAdmin = document.body.dataset.isAdmin === 'true';
            const basePath = isAdmin ? '/admin' : '/petugas';

            fetch(getBaseUrl() + basePath + '/visits/' + editModal.dataset.visitId + '/edit', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (!data.success) return;

                    empSelect.innerHTML = '<option value="">Pilih Pegawai</option>';

                    data.employees
                        .filter(function (emp) {
                            return String(emp.department_id) === String(deptId);
                        })
                        .forEach(function (emp) {
                            const option = document.createElement('option');
                            option.value = emp.id;
                            option.textContent = emp.name;
                            empSelect.appendChild(option);
                        });
                })
                .catch(function (error) {
                    console.error('Fetch employees error:', error);
                });
        });
    }

    const editForm = document.getElementById('editVisitForm');

    if (editForm) {
        editForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const submitBtn = document.getElementById('editSubmitBtn');
            const visitId = editModal.dataset.visitId;

            if (!visitId) return;

            document.querySelectorAll('[id^="edit_error_"]').forEach(function (el) {
                el.hidden = true;
                el.textContent = '';
            });

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

            const isAdmin = document.body.dataset.isAdmin === 'true';
            const basePath = isAdmin ? '/admin' : '/petugas';

            const formData = new FormData(editForm);

            fetch(getBaseUrl() + basePath + '/visits/update/' + visitId, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken(),
                },
                body: formData,
            })
                .then(function (response) {
                    return response.json();
                })
                .then(function (data) {
                    if (data.success) {
                        queueToast('Data kunjungan berhasil diperbarui.', 'success');
                        window.location.reload();
                    } else {
                        if (data.errors) {
                            Object.keys(data.errors).forEach(function (field) {
                                const errorEl = document.getElementById('edit_error_' + field);
                                if (errorEl) {
                                    errorEl.hidden = false;
                                    errorEl.textContent = data.errors[field];
                                }
                            });
                        } else {
                            showToast(data.message || 'Gagal menyimpan data.', 'error');
                        }

                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="bi bi-save"></i> Simpan Perubahan';
                    }
                })
                .catch(function (error) {
                    console.error('Edit submit error:', error);
                    handleOfflineError('Gagal menyimpan perubahan. Silakan coba lagi.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-save"></i> Simpan Perubahan';
                });
        });
    }

    // DELETE
    const deleteModal = document.getElementById('deleteVisitModal');

    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            deleteModal.dataset.visitId = visitId;

            setText('delete_visit_code', btn.dataset.visitCode || '-');
            setText('delete_guest_name', btn.dataset.guestName || '-');

            const form = document.getElementById('deleteVisitForm');
            if (form) {
                form.action = getBaseUrl() + '/admin/visits/delete/' + visitId;
            }

            const urlParams = new URLSearchParams(window.location.search);
            const fromInput = document.getElementById('delete_from');
            const menuInput = document.getElementById('delete_menu');

            if (fromInput) fromInput.value = urlParams.get('status') || 'aktif';
            if (menuInput) menuInput.value = urlParams.get('menu') || 'aktif';
        });
    }

    // RESTORE
    const restoreModal = document.getElementById('restoreVisitModal');

    if (restoreModal) {
        restoreModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;

            if (!btn) {
                return;
            }

            const visitId = btn.dataset.visitId;

            restoreModal.dataset.visitId = visitId;

            setText('restore_visit_code', btn.dataset.visitCode || '-');
            setText('restore_guest_name', btn.dataset.guestName || '-');

            const form = document.getElementById('restoreVisitForm');
            if (form) {
                form.action = getBaseUrl() + '/admin/visits/restore/' + visitId;
            }

            const urlParams = new URLSearchParams(window.location.search);
            const fromInput = document.getElementById('restore_from');
            const menuInput = document.getElementById('restore_menu');

            if (fromInput) fromInput.value = urlParams.get('status') || 'terhapus';
            if (menuInput) menuInput.value = urlParams.get('menu') || 'aktif';
        });
    }

    // HELPER - FORMAT DURATION
    function formatDuration(seconds) {
        if (!seconds || seconds < 0) return '-';

        seconds = parseInt(seconds);

        if (seconds < 60) {
            return seconds + ' detik';
        }

        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);

        if (days > 0) {
            return days + ' hari ' + (hours % 24) + ' jam';
        }

        if (hours > 0) {
            return hours + ' jam ' + (minutes % 60) + ' menit';
        }

        return minutes + ' menit';
    }

    // FILTER PEGAWAI BY DEPARTEMEN
    const deptFilter = document.getElementById('visitsDepartmentFilter');
    const empFilter = document.getElementById('visitsEmployeeFilter');

    if (deptFilter && empFilter) {

        const employeesData = window.visitsEmployeesData || [];

        const selectedEmpId = empFilter.dataset.selected || '';

        deptFilter.addEventListener('change', function () {
            const deptId = this.value;

            empFilter.innerHTML = '';

            if (!deptId) {
                empFilter.disabled = true;

                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Pilih departemen dulu';
                empFilter.appendChild(option);

                return;
            }

            empFilter.disabled = false;

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Semua Pegawai';
            empFilter.appendChild(defaultOption);

            employeesData
                .filter(function (emp) {
                    return String(emp.department_id) === String(deptId);
                })
                .forEach(function (emp) {
                    const option = document.createElement('option');
                    option.value = emp.id;
                    option.textContent = emp.name;

                    if (String(emp.id) === String(selectedEmpId)) {
                        option.selected = true;
                    }

                    empFilter.appendChild(option);
                });
        });

        if (deptFilter.value) {
            deptFilter.dispatchEvent(new Event('change'));
        }
    }

});