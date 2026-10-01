document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    const skeletonHTML = `
        <div class="app-loading">
            <div class="app-loading-spinner"></div>
            <span>Memuat data...</span>
        </div>
        `;

    function showLoading(container) {
        const isEmpty =
            container.innerHTML.trim() === '' ||
            container.querySelector('.app-empty') !== null;

        if (isEmpty) {
            container.innerHTML = skeletonHTML;
        } else {
            container.classList.add('is-loading');
        }
    }

    function hideLoading(container) {
        container.classList.remove('is-loading');
    }

    function handleForm(form) {

        const containerId = form.id.replace('FilterForm', 'Content');
        const container = document.getElementById(containerId);

        if (!container) {
            return;
        }

        const searchInput = form.querySelector('input[type="search"]');
        const selects = form.querySelectorAll('select');

        const actionUrl = form.getAttribute('action') || '';
        const partialUrl = actionUrl.replace(/\/$/, '') + '/partial';

        let currentRequest = null;
        let currentPage = 1;

        function fetchData(page) {
            page = page || 1;

            if (currentRequest) {
                currentRequest.abort();
            }

            currentRequest = new AbortController();

            const formData = new FormData(form);
            formData.set('page', page);

            const params = new URLSearchParams(formData);

            form.dispatchEvent(new CustomEvent('ajax:before', {
                detail: {
                    form: form,
                    page: page,
                    container: container,
                },
            }));

            showLoading(container);

            fetch(partialUrl + '?' + params.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                signal: currentRequest.signal,
            })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error(
                        'HTTP error: ' + response.status
                        );
                    }
                    return response.json();
                })
                .then(function (data) {
                  container.innerHTML = data.html;

                    if (data.pagination) {
                        currentPage =
                            Number(data.pagination.page) || page;
                    } else {
                        currentPage = page;
                    }

                    form.dispatchEvent(new CustomEvent('ajax:after', {
                        detail: {
                            form: form,
                            page: currentPage,
                            data: data,
                            container: container,
                        },
                    }));
                })
                .catch(function (error) {
                    if (error.name === 'AbortError') {
                        return;
                    }

                    console.error('Fetch error:', error);

                    form.dispatchEvent(new CustomEvent('ajax:error', {
                        detail: {
                            form: form,
                            error: error,
                            container: container,
                        },
                    }));

                    container.innerHTML = `
                        <div class="app-empty">
                            <div class="app-empty-icon">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <h2 class="app-empty-title">Gagal memuat data</h2>
                            <p class="app-empty-text">Silakan coba lagi.</p>
                        </div>
                    `;
                })

                .finally(function () {
                    hideLoading(container);
                });
        }

        form.__fetchData = fetchData;

        let searchTimer = null;

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function () {
                    fetchData(1);
                }, 300);
            });
        }

        selects.forEach(function (select) {
            select.addEventListener('change', function () {
                fetchData(1);
            });
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            fetchData(1);
        });
    }

    document.querySelectorAll('.master-toolbar[id$="FilterForm"]').forEach(handleForm);

    document.querySelectorAll('.master-toolbar[id$="FilterForm"]').forEach(function (form) {
        const resetButton = form.querySelector('[id$="ResetFilter"]');

        if (!resetButton) {
            return;
        }

        resetButton.addEventListener('click', function () {

            form.reset();

            const searchInput = form.querySelector('input[type="search"]');

            if (searchInput) {
                searchInput.value = '';
            }

            if (typeof form.__fetchData === 'function') {
                form.__fetchData(1);
            }

        });

    });

    document.addEventListener('click', function (event) {

            const pageButton = event.target.closest('[data-page]');

            if (pageButton) {
                event.preventDefault();

                const page = Number(pageButton.dataset.page);

                if (!Number.isInteger(page) || page < 1) {
                    return;
                }

                const container = pageButton.closest('[id$="PaginationList"]')
                    || pageButton.closest('.master-pagination');

                if (!container) {
                    return;
                }

                const formId = container.id
                    ? container.id.replace('PaginationList', 'FilterForm')
                    : '';

                const form = document.getElementById(formId);

                if (form && typeof form.__fetchData === 'function') {
                    form.__fetchData(page);
                }

                return;
            }

        const link = event.target.closest('.master-pagination-list a');

        if (!link) {
            return;
        }

        const url = link.getAttribute('href');

        if (!url || url === '#') {
            return;
        }

        event.preventDefault();

        const page = new URL(url, window.location.origin).searchParams.get('page') || 1;

        const container = link.closest('[id$="PaginationList"]');

        if (!container) {
            return;
        }

        const formId = container.id.replace('PaginationList', 'FilterForm');
        const form = document.getElementById(formId);

        if (form && typeof form.__fetchData === 'function') {
            form.__fetchData(page);
        }

    });

    document.addEventListener('click', function (event) {

        const button = event.target.closest('.master-password-toggle');

        if (!button) {
            return;
        }

        const targetId = button.dataset.passwordTarget;
        const input = document.getElementById(targetId);

        if (!input) {
            return;
        }

        const icon = button.querySelector('i');
        const isPassword = input.type === 'password';

        input.type = isPassword ? 'text' : 'password';

        if (icon) {
            icon.className = isPassword
                ? 'bi bi-eye-slash'
                : 'bi bi-eye';
        }

        button.setAttribute(
            'aria-label',
            isPassword
                ? 'Sembunyikan password'
                : 'Tampilkan password'
        );

        button.setAttribute(
            'title',
            isPassword
                ? 'Sembunyikan password'
                : 'Tampilkan password'
        );

    });

    document.querySelectorAll('.toast').forEach(function (toastEl) {
        if (toastEl.closest('.app-toast-container')) {
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });

});