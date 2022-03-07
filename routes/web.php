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
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/privacy-policy', function () {
    return view('policy');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/portfolio', function () {
    return view('portfolio');
});
Route::get('/choose', function () {
    return view('choose');
});
Route::get('/invest-first', function () {
    return view('invest-first');
});
Route::get('/invest-second', function () {
    return view('invest-second');
});
Route::get('/inquire-first', function () {
    return view('inquire-first');
});
Route::get('/inquire-second', function () {
    return view('inquire-second');
});
Route::get('/thanks', function () {
    return view('thanks');
});
Route::get('/cross-chain', function () {
    return view('crosschain');
});
Route::get('/defi', function () {
    return view('defi');
});
Route::get('/metaverse', function () {
    return view('metaverse');
});
