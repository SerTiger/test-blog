<?php

namespace App\Services;

use GuzzleHttp\Client;

class PlatformService
{
    private function getLocale()
    {
        $locale = app()->getLocale();

        switch ($locale) {
            case 'ua' :
                $locale = 'uk';
                break;
            case 'us' :
                $locale = 'en';
                break;
        }

        return $locale;

    }
}
