<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'ru';

    public static $languages = ['ru', 'ua'];

    public static function getLocale()
    {
        $uri = Request::path();

        $segmentsURI = explode('/', $uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {

            if ($segmentsURI[0] != self::$mainLanguage) {
                App::setLocale($segmentsURI[0]);

                return $segmentsURI[0];
            }
        }

        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $locale = self::getLocale();

        if ($locale) {
            App::setLocale($locale);
        } else {
            App::setLocale(self::$mainLanguage);
        }

        return $next($request);
    }

    public static function getNonCurrentLanguages(): array
    {
        $languages = self::$languages;

        $current_locale = app()->getLocale();

        $key = array_search($current_locale, $languages);

        unset($languages[$key]);

        return $languages;
    }

    public static function getCurrentLanguage(): string
    {
        return app()->getLocale();
    }
}
