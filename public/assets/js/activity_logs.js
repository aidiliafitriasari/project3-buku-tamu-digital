document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = document.body.dataset.baseUrl || '';

    const filterForm = document.getElementById('activityLogsFilterForm');
    const content = document.getElementById('activityLogsContent');
    const loading = document.getElementById('activityLogsLoading');

    if (filterForm && content) {

        filterForm.addEventListener('ajax:before', function () {
            content.classList.add('is-loading');
            if (loading) loading.hidden = false;
        });

        filterForm.addEventListener('ajax:after', function () {
            content.classList.remove('is-loading');
            if (loading) loading.hidden = true;
        });

        filterForm.addEventListener('ajax:error', function () {
            content.classList.remove('is-loading');
            if (loading) loading.hidden = true;
        });
    }


    // DETAIL MODAL
    const detailModal = document.getElementById('detailActivityLogModal');

    if (detailModal) {

        detailModal.addEventListener('show.bs.modal', function (event) {

            const button = event.relatedTarget;
            if (!button) return;

            const id = button.dataset.logId || '-';
            const createdAt = button.dataset.logCreatedAt || '-';
            const username = button.dataset.logUsername || '';
            const role = button.dataset.logRole || '';
            const activity = button.dataset.logActivity || '-';
            const module = button.dataset.logModule || '-';
            const visitId = button.dataset.logVisitId || '';
            const statusHistoryId = button.dataset.logStatusHistoryId || '';
            const description = button.dataset.logDescription || '-';

            // ID
            document.getElementById('detail_log_id').textContent = '#' + id;

            // Waktu
            if (createdAt !== '-') {
                const date = new Date(createdAt.replace(' ', 'T'));

                const options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                };

                document.getElementById('detail_log_created_at').textContent =
                    date.toLocaleString('id-ID', options);
            }

            // User
            const usernameEl = document.getElementById('detail_log_username');
            const roleEl = document.getElementById('detail_log_role');

            if (username) {
                usernameEl.textContent = username;

                const roleMap = {
                    administrator: 'Administrator',
                    petugas: 'Petugas',
                };

                roleEl.textContent = roleMap[role] || '';
            } else {
                usernameEl.innerHTML = '<span class="app-badge app-badge-deleted">System</span>';
                roleEl.textContent = '';
            }

            // Aktivitas
            const activityEl = document.getElementById('detail_log_activity');
            activityEl.innerHTML = '';

            const badge = document.createElement('span');
            badge.className = 'app-badge app-badge-active';
            badge.textContent = activity;
            activityEl.appendChild(badge);
            // Module
            document.getElementById('detail_log_module').textContent = module;

            // Visit ID
            document.getElementById('detail_log_visit_id').textContent =
                visitId ? '#' + visitId : '-';

            // Status History ID
            document.getElementById('detail_log_status_history_id').textContent =
                statusHistoryId ? '#' + statusHistoryId : '-';

            // Deskripsi
            document.getElementById('detail_log_description').textContent =
                description || '-';
        });
    }

});