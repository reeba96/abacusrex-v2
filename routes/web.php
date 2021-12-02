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
/*
Route::get('/', function () {
    return view('welcome');
});*/


Route::group(['prefix' => LaravelLocalization::setLocale(),
                 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web' ]], function() {

    Auth::routes();
});


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');






Route::group([
    'prefix' => 'invoice-accounts',
], function () {
    Route::get('/', 'InvoiceAccountController@index')
         ->name('invoice-accounts.invoice-accounts.index');
    Route::get('/create','InvoiceAccountController@create')
         ->name('invoice-accounts.invoice-accounts.create');
    Route::get('/show/{InvoiceAccount}','InvoiceAccountController@show')
         ->name('invoice-accounts.invoice-accounts.show')->where('id', '[0-9]+');
    Route::get('/{InvoiceAccount}/edit','InvoiceAccountController@edit')
         ->name('invoice-accounts.invoice-accounts.edit')->where('id', '[0-9]+');
    Route::post('/', 'InvoiceAccountController@store')
         ->name('invoice-accounts.invoice-accounts.store');
    Route::put('invoice-accounts/{InvoiceAccount}', 'InvoiceAccountController@update')
         ->name('invoice-accounts.invoice-accounts.update')->where('id', '[0-9]+');
    Route::delete('/invoice-accounts/{InvoiceAccount}','InvoiceAccountController@destroy')
         ->name('invoice-accounts.invoice-accounts.destroy')->where('id', '[0-9]+');
});
