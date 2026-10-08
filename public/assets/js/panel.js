document.addEventListener('DOMContentLoaded', function () {

    const toggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');
    const sidebar = document.querySelector('.panel-sidebar');
    const main = document.querySelector('.panel-main');

    if (!toggle || !sidebar) {
        return;
    }

    function isDesktop() {
        return window.matchMedia('(min-width: 992px)').matches;
    }

    toggle.addEventListener('click', function () {
        if (isDesktop()) {
            sidebar.classList.toggle('is-collapsed');

            if (main) {
                main.classList.toggle('is-sidebar-collapsed');
            }

            const isCollapsed = sidebar.classList.contains('is-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed ? '1' : '0');

            return;
        }

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

    if (isDesktop() && localStorage.getItem('sidebar-collapsed') === '1') {
        sidebar.classList.add('is-collapsed');

        if (main) {
            main.classList.add('is-sidebar-collapsed');
        }
    }

});

document.addEventListener('DOMContentLoaded', function () {

    const menuBtn = document.getElementById('bottomNavMenuBtn');

    if (!menuBtn) {
        return;
    }

    menuBtn.addEventListener('click', function () {
        const sidebar = document.querySelector('.panel-sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (!sidebar) {
            return;
        }

        sidebar.classList.toggle('is-open');

        if (overlay) {
            overlay.classList.toggle('is-visible');
        }
    });

});