<?php

if (! function_exists('mask_phone')) {

    function mask_phone(?string $phone): string
    {
        if (empty($phone)) {
            return '-';
        }

        $phone = preg_replace('/\s+/', '', $phone);

        $length = strlen($phone);

        if ($length < 7) {
            return $phone;
        }

        $start = substr($phone, 0, 4);
        $end   = substr($phone, -3);

        return $start . '****' . $end;
    }
}

if (! function_exists('mask_identity')) {

    function mask_identity(?string $identity): string
    {
        if (empty($identity)) {
            return '-';
        }

        $identity = preg_replace('/\s+/', '', $identity);

        $length = strlen($identity);

        if ($length < 7) {
            return $identity;
        }

        $start = substr($identity, 0, 4);
        $end   = substr($identity, -2);

        return $start . '****' . $end;
    }
}
