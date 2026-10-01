<?php
helper('color');

$primaryColor = null;

if (session()->has('app_primary_color')) {
    $primaryColor = session()->get('app_primary_color');
}

if (! $primaryColor) {
    $settingModel = new \App\Models\SettingModel();
    $settings = $settingModel->first();
    $primaryColor = $settings['primary_color'] ?? '#2d6a4f';

    session()->set('app_primary_color', $primaryColor);
}

$palette = generate_primary_palette($primaryColor);
?>

<style>
    :root {
        --app-primary: <?= esc($palette['primary']) ?>;
        --app-primary-dark: <?= esc($palette['primary_dark']) ?>;
        --app-primary-light: <?= esc($palette['primary_light']) ?>;
        --app-primary-soft: <?= esc($palette['primary_soft']) ?>;
        --app-primary-soft-hover: <?= esc($palette['primary_soft_hover']) ?>;
    }
</style>