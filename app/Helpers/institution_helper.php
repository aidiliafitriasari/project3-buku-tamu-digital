<?php

if (! function_exists('institution_name')) {
    function institution_name(): string
    {
        $fallback = 'Buku Tamu Digital';

        try {
            $model = new \App\Models\InstitutionProfileModel();
            $profile = $model->first();

            if (! empty($profile['name'])) {
                return (string) $profile['name'];
            }
        } catch (\Throwable $e) {
        }

        return $fallback;
    }
}

if (! function_exists('institution_logo')) {
    function institution_logo(): ?string
    {
        try {
            $model = new \App\Models\InstitutionProfileModel();
            $profile = $model->first();

            if (! empty($profile['logo'])) {
                return (string) $profile['logo'];
            }
        } catch (\Throwable $e) {
        }

        return null;
    }
}
