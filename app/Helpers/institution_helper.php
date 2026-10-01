<?php

if (! function_exists('institution_profile')) {

    function institution_profile(): ?array
    {
        static $cachedProfile = null;
        static $alreadyLoaded = false;

        if ($alreadyLoaded) {
            return $cachedProfile;
        }

        $alreadyLoaded = true;

        try {
            $model = new \App\Models\InstitutionProfileModel();
            $profile = $model->first();

            if (! empty($profile)) {
                $cachedProfile = $profile;
                return $cachedProfile;
            }
        } catch (\Throwable $e) {
            // Fallback
        }

        $cachedProfile = null;

        return $cachedProfile;
    }
}

if (! function_exists('institution_name')) {

    function institution_name(): string
    {
        $fallback = 'Buku Tamu Digital';

        $profile = institution_profile();

        if (! empty($profile['name'])) {
            return (string) $profile['name'];
        }

        return $fallback;
    }
}

if (! function_exists('institution_logo')) {

    function institution_logo(): ?string
    {
        $profile = institution_profile();

        if (! empty($profile['logo'])) {
            return (string) $profile['logo'];
        }

        return null;
    }
}

if (! function_exists('institution_address')) {
    function institution_address(): ?string
    {
        $profile = institution_profile();

        if (! empty($profile['address'])) {
            return (string) $profile['address'];
        }

        return null;
    }
}

if (! function_exists('institution_phone')) {
    function institution_phone(): ?string
    {
        $profile = institution_profile();

        if (! empty($profile['phone'])) {
            return (string) $profile['phone'];
        }

        return null;
    }
}

if (! function_exists('institution_email')) {
    function institution_email(): ?string
    {
        $profile = institution_profile();

        if (! empty($profile['email'])) {
            return (string) $profile['email'];
        }

        return null;
    }
}
