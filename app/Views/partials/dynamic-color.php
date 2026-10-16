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

function hex_to_rgb_triplet(string $hex): string
{
    $hex = ltrim($hex, '#');

    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    return "{$r}, {$g}, {$b}";
}

$primaryRgb = hex_to_rgb_triplet($palette['primary']);

?>

<style>
    :root {
        --app-primary: <?= esc($palette['primary']) ?>;
        --app-primary-dark: <?= esc($palette['primary_dark']) ?>;
        --app-primary-light: <?= esc($palette['primary_light']) ?>;
        --app-primary-soft: <?= esc($palette['primary_soft']) ?>;
        --app-primary-soft-hover: <?= esc($palette['primary_soft_hover']) ?>;

        --app-primary-rgb: <?= esc($primaryRgb) ?>;
    }
</style>