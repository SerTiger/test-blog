<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use YAAP\Theme\Facades\Theme;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Theme::init('default');

Route::get('/', function () {
    return view('main');
})->name('home');

Route::get('/invest-first', [\App\Http\Controllers\Front\InvestController::class, 'invest_first'])
    ->middleware('web')
    ->name('invest-first');
Route::any('/invest-second', [\App\Http\Controllers\Front\InvestController::class, 'invest_second'])
    ->middleware('web')
    ->name('invest-second');
Route::any('/invest-thanks', [\App\Http\Controllers\Front\InvestController::class, 'invest_thanks'])
    ->middleware('web')
    ->name('invest-thanks');

Route::middleware(['web'])
    ->group(function () {

    Route::get('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');
});

Route::middleware(['web'])
    ->prefix('metamask')
    ->group(function () {

    Route::get('/ethereum/signature', [\App\Http\Controllers\Auth\AuthController::class, 'signature'])
        ->name('metamask.signature')
        ->middleware('guest:web');

    Route::post('/ethereum/authenticate', [\App\Http\Controllers\Auth\AuthController::class, 'login'])
        ->middleware(['guest:web'])
        ->name('metamask.authenticate');

    Route::middleware(['auth'])
        ->group(function () {

            Route::post('/ethereum/switch', [\App\Http\Controllers\Auth\AuthController::class, 'switch'])
                ->name('metamask.switch');

            Route::post('/transaction/create', [\App\Http\Controllers\Auth\Web3AuthController::class, 'createTransaction'])
                ->middleware(['guest:web'])
                ->name('metamask.transaction.create');

            Route::post('/transaction/list', [\App\Http\Controllers\Auth\Web3AuthController::class, 'listTransaction'])
                ->middleware(['guest:web'])
                ->name('metamask.transaction.list');

        });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        //'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::middleware(['web', 'auth'])
        ->prefix('organization')
        ->group(function () {

            Route::get('/create', [\App\Http\Controllers\Front\CompanyController::class, 'create'])
                ->name('organization.create');

            Route::post('/create', [\App\Http\Controllers\Front\CompanyController::class, 'store'])
                ->name('organization.store');

        });

    Route::middleware(['web', 'auth', 'has.company'])
        ->group(function () {

            Route::middleware(['has.company'])
                ->group(function () {

                    Route::prefix('profile')
                        ->group(function () {

                            Route::post('/', [\App\Http\Controllers\Front\CompanyController::class, 'update']);

                        });

                    Route::get('/pools', [\App\Http\Controllers\Front\PoolController::class, 'index'])
                        ->name('company.pools');

                    Route::prefix('pool')
                        ->group(function () {

                            Route::get('/create', [\App\Http\Controllers\Front\PoolController::class, 'create'])
                                ->name('pool.create');
                            Route::post('/create', [\App\Http\Controllers\Front\PoolController::class, 'store'])
                                ->name('pool.store');;
                            Route::get('/edit/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'edit'])
                                ->name('pool.edit');
                            Route::post('/edit/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'update'])
                                ->name('pool.update');
                        });
                });


            Route::get('/pool', function () {
                return view('pool');
            });
            Route::get('/profile', function () {
                return view('profile');
            })
                ->name('account.index');

            Route::get('/contributions', function () {
                return view('contributions');
            })->name('contribution.index');
        });

});


Route::get('/loading', function () {
    return view('loading');
});
Route::get('/await', function () {
    return view('await');
});
Route::get('/admin-profile', function () {
    return view('admin-profile');
});
