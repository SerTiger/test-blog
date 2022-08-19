<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {

            $current_user = auth()->user();
            $current_company = $current_user ? $current_user->company : new \stdClass();

            $view->with('CURRENT_USER', $current_user ?? new \stdClass());
            $view->with('CURRENT_COMPANY', $current_company ?? new \stdClass());
        });
    }
}
