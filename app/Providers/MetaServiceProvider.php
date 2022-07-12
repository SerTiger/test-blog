<?php

namespace App\Providers;

use App\Classes\Meta;
use Illuminate\Support\ServiceProvider;

class MetaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            'meta',
            function () {
                return new Meta();
            }
        );
    }
}