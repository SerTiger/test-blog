<?php

use Illuminate\Support\Facades\Route;

use YAAP\Theme\Facades\Theme;
Theme::init('adminlte');

Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.'
    ],
    function ()
    {
        Route::group(
            [
                'middleware' => 'auth.admin',
            ],
            function () {
                Route::resource('user', 'UserController');
                Route::resource('permissions', 'PermissionsController');
                Route::resource('roles', 'RolesController');

                Route::post('pages/{id}/ajax_field','PageController@ajaxFieldChange')->middleware('ajax')->name('pages.ajax_field');
                Route::resource('pages', 'PageController');

                Route::post('categories/{id}/ajax_field','CategoryController@ajaxFieldChange')->middleware('ajax')->name('categories.ajax_field');
                Route::resource('categories', 'CategoryController');

                Route::post('companies/{id}/ajax_field','CompanyController@ajaxFieldChange')->middleware('ajax')->name('companies.ajax_field');
                Route::resource('companies', 'CompanyController');

                Route::post('pools/{id}/ajax_field','PoolController@ajaxFieldChange')->middleware('ajax')->name('pool.ajax_field');
                Route::resource('pools', 'PoolController');

                Route::post('tags/{id}/ajax_field','TagController@ajaxFieldChange')->middleware('ajax')->name('tags.ajax_field');
                Route::resource('tags', 'TagController');

                /*Route::post('articles/{id}/ajax_field','ArticleController@ajaxFieldChange')->middleware('ajax')->name('articles.ajax_field');
                Route::resource('articles', 'ArticleController');*/

                //Route::resource('authors', 'AuthorController');

                Route::get(
                    'translation/{group}',
                    ['as' => 'translation.index', 'uses' => 'TranslationController@index']
                );
                Route::post(
                    'translation/{group}',
                    ['as' => 'translation.update', 'uses' => 'TranslationController@update']
                );
            });

        Route::get('login', 'AuthController@showLoginForm')->name('login');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout')->name('logout');

        Route::get('/','HomeController@index')->name('home');


    }
);
