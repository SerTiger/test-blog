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
Route::get('/create_organization', function () {
    return view('create_organization');
});
Route::get('/create_pool', function () {
    return view('create_pool');
});
Route::get('/pools', function () {
    return view('pools');
});
Route::get('/pool', function () {
    return view('pool');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/contributions', function () {
    return view('contributions');
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
