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
        ->middleware('guest:web')
        ->name('metamask.signature');

    Route::post('/ethereum/authenticate', [\App\Http\Controllers\Auth\AuthController::class, 'login'])
        ->middleware(['guest:web'])
        ->name('metamask.authenticate');

    Route::get('/ethereum/sign', [\App\Http\Controllers\Auth\AuthController::class, 'signature'])
        ->middleware(['auth'])
        ->name('metamask.sign');

    Route::middleware(['auth'])
        ->group(function () {

            Route::post('/ethereum/switch', [\App\Http\Controllers\Auth\AuthController::class, 'switch'])
                ->name('metamask.switch');

            Route::post('/transaction/create', [\App\Http\Controllers\Auth\Web3AuthController::class, 'createTransaction'])
                ->name('metamask.transaction.create');

            Route::post('/transaction/list', [\App\Http\Controllers\Auth\Web3AuthController::class, 'listTransaction'])
                ->name('metamask.transaction.list');

        });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        //'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function() {

    Route::middleware(['web'])
        ->group(function () {

            Route::get('/pub/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'page'])
                ->name('pool')
                ->whereUuid('uuid');

        });

    Route::middleware(['web', 'auth'])
        ->prefix('organization')
        ->group(function () {

            Route::get('/create', [\App\Http\Controllers\Front\CompanyController::class, 'create'])
                ->name('organization.create');

            Route::post('/create', [\App\Http\Controllers\Front\CompanyController::class, 'store'])
                ->name('organization.store');

        });

    Route::middleware(['web', 'auth'])
        ->group(function () {

            Route::get('/transaction/{uuid}/sign', [\App\Http\Controllers\Front\PoolController::class, 'sign'])
                ->name('pool.transaction.sign')
                ->whereUuid('uuid');

            Route::post('/transaction/{uuid}/create', [\App\Http\Controllers\Front\PoolController::class, 'transaction'])
                ->name('pool.transaction.create')
                ->whereUuid('uuid');

            Route::post('/transaction/{scope}/rollback', [\App\Http\Controllers\Front\PoolController::class, 'rollback'])
                ->name('pool.transaction.rollback')
                ->whereUuid('scope');

            Route::post('/transaction/{uuid}/confirm', [\App\Http\Controllers\Front\PoolController::class, 'transaction_confirm'])
                ->name('pool.transaction.confirm')
                ->whereUuid('uuid');

            Route::post('/transaction/{scope}/revert', [\App\Http\Controllers\Front\PoolController::class, 'transaction_revert'])
                ->name('pool.transaction.revert')
                ->whereUuid('scope');

            Route::get('/transaction/{scope}/await', [\App\Http\Controllers\Front\PoolController::class, 'transaction_await'])
                ->name('pool.transaction.await')
                ->whereUuid('scope');

            Route::post('/transaction/{scope}/notify', [\App\Http\Controllers\Front\PoolController::class, 'transaction_notify'])
                ->name('pool.transaction.notify')
                ->whereUuid('scope');

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
                                ->name('pool.store');
                            Route::get('/show/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'show'])
                                ->name('pool.show');
                            Route::get('/edit/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'edit'])
                                ->name('pool.edit');
                            Route::post('/edit/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'update'])
                                ->name('pool.update');

                            Route::post('/start/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'start'])
                                ->name('pool.start');
                            Route::post('/stop/{uuid}', [\App\Http\Controllers\Front\PoolController::class, 'stop'])
                                ->name('pool.stop');
                        });

                    Route::prefix('contribution')
                        ->group(function () {

                            Route::get('/', [\App\Http\Controllers\Front\ContributionController::class, 'index'])
                                ->name('contribution.index');
                        });

                    Route::prefix('account')
                        ->group(function () {

                            Route::get('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'index'])
                                ->name('account.index');
                            Route::post('/profile', [\App\Http\Controllers\Front\ProfileController::class, 'update'])
                                ->name('account.update');
                        });

                });

        });
});
