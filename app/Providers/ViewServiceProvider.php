<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            $current_wallet = $current_user ? $current_user->wallets()->where('address',$current_user->auth_address)->first() : new \stdClass();

            $view->with('CURRENT_USER', $current_user ?? new \stdClass());
            $view->with('CURRENT_COMPANY', $current_company ?? new \stdClass());
            $view->with('CURRENT_WALLET', $current_wallet ?? new \stdClass());
            $view->with('CURRENT_LOCALE', LaravelLocalization::getCurrentLocale());
        });
    }
}
