<!-- PWA META TAGS -->
<link rel="manifest" href="<?= base_url('manifest.json') ?>">

<meta name="theme-color" content="<?= esc($primaryColor ?? '#00309F') ?>">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="Buku Tamu">

<link rel="apple-touch-icon" href="<?= base_url('assets/icons/apple-touch-icon.png') ?>">

<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/icons/favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/icons/favicon-16x16.png') ?>">

<!-- PWA Styles -->
<link rel="stylesheet" href="<?= base_url('assets/css/pwa.css') ?>">

<!-- REGISTER SERVICE WORKER -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('<?= base_url('sw.js') ?>')
                .then(registration => {
                    console.log('Service Worker berhasil didaftarkan:', registration.scope);
                })
                .catch(error => {
                    console.error('Service Worker gagal didaftarkan:', error);
                });
        });
    }
</script>