document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('reportFilterForm');
    const tableContainer = document.getElementById('reportTableContainer');
    const summaryContainer = document.getElementById('reportSummaryContainer');
    const periodSelect = document.getElementById('filter_period');
    const customGroups = document.querySelectorAll('.report-filter-custom');
    const resetBtn = document.getElementById('reportResetFilter');

    if (!form) return;

    const config = window.reportConfig || {};
    const partialUrl = config.partialUrl;

    // UPDATE EXPORT LINKS (PDF/EXCEL/PRINT)
    function updateExportLinks() {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);

        for (const [key, value] of [...params.entries()]) {
            if (value === '' || value === '0') {
                params.delete(key);
            }
        }

        const queryString = params.toString();

        // Print
        const printBtn = document.getElementById('reportPrintBtn');
        if (printBtn) {
            const baseUrl = printBtn.dataset.url;
            printBtn.href = baseUrl + (queryString ? '?' + queryString : '');
        }

        // PDF
        const pdfBtn = document.getElementById('reportPdfBtn');
        if (pdfBtn) {
            const baseUrl = pdfBtn.dataset.url;
            const format = pdfBtn.dataset.format || 'pdf';
            const pdfParams = new URLSearchParams(queryString);
            pdfParams.set('format', format);
            pdfBtn.href = baseUrl + '?' + pdfParams.toString();
        }

        // Excel
        const excelBtn = document.getElementById('reportExcelBtn');
        if (excelBtn) {
            const baseUrl = excelBtn.dataset.url;
            const format = excelBtn.dataset.format || 'excel';
            const excelParams = new URLSearchParams(queryString);
            excelParams.set('format', format);
            excelBtn.href = baseUrl + '?' + excelParams.toString();
        }
    }

    // ============================================================
    updateExportLinks();

    // TOGGLE CUSTOM DATE FIELDS
    function toggleCustomFields() {
        const isCustom = periodSelect.value === 'custom';
        customGroups.forEach(function (el) {
            el.classList.toggle('is-hidden', !isCustom);
        });
    }

    if (periodSelect) {
        periodSelect.addEventListener('change', function () {
            toggleCustomFields();
            updateExportLinks();
            fetchData();
        });
    }

    toggleCustomFields();

    // FETCH DATA (AJAX)
    let fetchTimeout = null;

    function fetchData(page) {
        if (!partialUrl) return;

        updateExportLinks();

        clearTimeout(fetchTimeout);

        fetchTimeout = setTimeout(function () {

            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            if (page) {
                params.set('page', page);
            }

            if (config.perPage) {
                params.set('per_page', config.perPage);
            }

            tableContainer.classList.add('report-loading');
            summaryContainer.classList.add('report-loading');

            fetch(partialUrl + '?' + params.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.html) {
                    tableContainer.innerHTML = data.html;
                }
                if (data.summaryHtml) {
                    summaryContainer.innerHTML = data.summaryHtml;
                }
            })
            .catch(function (err) {
                console.error('[Reports] Fetch failed:', err);
            })
            .finally(function () {
                tableContainer.classList.remove('report-loading');
                summaryContainer.classList.remove('report-loading');
            });

        }, 300);
    }

    // SUBMIT FORM
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        fetchData(1);
    });

    form.querySelectorAll('select:not(#filter_period), input[type="date"]').forEach(function (el) {
        el.addEventListener('change', function () {
            updateExportLinks();
            fetchData(1);
        });
    });

    const originInput = form.querySelector('input[name="origin_institution"]');
    if (originInput) {
        originInput.addEventListener('input', function () {
            updateExportLinks();
            fetchData(1);
        });
    }

    // PAGINATION
    tableContainer.addEventListener('click', function (e) {
        const pageBtn = e.target.closest('.report-page-btn[data-page]');
        if (pageBtn) {
            e.preventDefault();
            const page = pageBtn.getAttribute('data-page');
            updateExportLinks();
            fetchData(page);
        }
    });

    // RESET
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            form.reset();
            periodSelect.value = 'harian';
            toggleCustomFields();
            updateExportLinks();
            fetchData(1);
        });
    }

});