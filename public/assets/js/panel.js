document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const sidebar = document.querySelector('.panel-sidebar');

    if (!toggle || !sidebar) {
        return;
    }

    toggle.addEventListener('click', function () {
        sidebar.classList.toggle('is-open');

        if (overlay) {
            overlay.classList.toggle('is-visible');
        }
    });

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
        });
    }

});