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
