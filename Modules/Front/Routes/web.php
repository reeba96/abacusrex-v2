<?php

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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {
   
    Route::get('/', 'FrontController@index')->name('page.index');

    Route::get('/esfinx', 'FrontController@esfinx')->name('page.esfinx');

    Route::get('/budzetski', 'FrontController@budzetski')->name('page.budzetski');

    Route::get('/vodovod', 'FrontController@vodovod')->name('page.vodovod');

});
