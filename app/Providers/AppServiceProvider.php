<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Collection::macro('recursive', function ($depth = null, $currentLayer = 1) {
            return $this->map(function ($value) use ($depth, $currentLayer) {
                if ((isset($depth) && $depth <= $currentLayer) || !(is_array($value) || is_object($value))) return $value;

                return collect($value)->recursive($depth, ($currentLayer + 1));
            });
        });
    }
}
