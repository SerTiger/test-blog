<?php

use Illuminate\Support\Facades\Route;
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
    return view('hello');
})->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/privacy-policy', function () {
    return view('policy');
})->name('privacy-policy');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');
Route::get('/choose', function () {
    return view('choose');
})->name('choose');

Route::get('/invest-first', [\App\Http\Controllers\Front\InvestController::class, 'invest_first'])
    ->middleware('web')
    ->name('invest-first');
Route::any('/invest-second', [\App\Http\Controllers\Front\InvestController::class, 'invest_second'])
    ->middleware('web')
    ->name('invest-second');
Route::any('/invest-thanks', [\App\Http\Controllers\Front\InvestController::class, 'invest_thanks'])
    ->middleware('web')
    ->name('invest-thanks');


Route::get('/inquire-first', function () {
    return view('inquire-first');
})->name('inquire-first');
Route::get('/inquire-second', function () {
    return view('inquire-second');
})->name('inquire-second');


Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');


Route::get('/cross-chain', function () {
    return view('crosschain');
})->name('cross-chain');
Route::get('/defi', function () {
    return view('defi');
})->name('defi');
Route::get('/metaverse', function () {
    return view('metaverse');
})->name('metaverse');
Route::get('/gaming', function () {
    return view('gaming');
})->name('gaming');
Route::get('/nft', function () {
    return view('nft');
})->name('nft');

Route::middleware(['web'])
    ->group(function () {

    Route::get('/admin/login', [\App\Http\Controllers\Backend\AuthController::class, 'showLoginForm'])
        ->middleware('guest:web');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->name('login')
        ->middleware('guest:web');

    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');
});

Route::middleware(['web'])
    ->prefix('metamask')
    ->group(function () {

    Route::get('/ethereum/signature', [\App\Http\Controllers\Web3AuthController::class, 'signature'])
        ->name('metamask.signature')
        ->middleware('guest:web');

    Route::post('/ethereum/authenticate', [\App\Http\Controllers\Web3AuthController::class, 'authenticate'])
        ->middleware(['guest:web'])
        ->name('metamask.authenticate');

    Route::post('/transaction/create', [\App\Http\Controllers\Web3AuthController::class, 'createTransaction'])
        ->middleware(['guest:web'])
        ->name('metamask.transaction.create');

    Route::post('/transaction/list', [\App\Http\Controllers\Web3AuthController::class, 'listTransaction'])
        ->middleware(['guest:web'])
        ->name('metamask.transaction.list');
});
