<?php

if (! function_exists('hex_to_rgb')) {

    function hex_to_rgb(string $hex): array
    {
        $hex = ltrim($hex, '#');

        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0]
                . $hex[1] . $hex[1]
                . $hex[2] . $hex[2];
        }

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }
}

if (! function_exists('rgb_to_hex')) {

    function rgb_to_hex(int $r, int $g, int $b): string
    {
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}

if (! function_exists('adjust_brightness')) {

    function adjust_brightness(string $hex, int $percent): string
    {
        $rgb = hex_to_rgb($hex);

        $r = max(0, min(255, (int) ($rgb['r'] + ($rgb['r'] * $percent / 100))));
        $g = max(0, min(255, (int) ($rgb['g'] + ($rgb['g'] * $percent / 100))));
        $b = max(0, min(255, (int) ($rgb['b'] + ($rgb['b'] * $percent / 100))));

        return rgb_to_hex($r, $g, $b);
    }
}

if (! function_exists('generate_primary_palette')) {

    function generate_primary_palette(string $primary): array
    {
        $rgb = hex_to_rgb($primary);

        return [
            'primary' => $primary,
            'primary_dark' => adjust_brightness($primary, -20),
            'primary_light' => adjust_brightness($primary, 20),
            'primary_soft' => sprintf(
                'rgba(%d, %d, %d, 0.08)',
                $rgb['r'],
                $rgb['g'],
                $rgb['b']
            ),
            'primary_soft_hover' => sprintf(
                'rgba(%d, %d, %d, 0.12)',
                $rgb['r'],
                $rgb['g'],
                $rgb['b']
            ),
        ];
    }
}
