<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( ['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.','middleware' => ['apilogger']], function ($router) {

    Route::post('login', 'AuthController@login');

    Route::group( [ 'middleware' => ['auth:api'] ], function ($router) {
       /* Route::get('/user', function (Request $request) {
            return $request->user();
        });*/
        Route::post('logout', 'AuthController@logout');

        Route::post('shop_register', 'ShopUsersController@store');
        Route::post('shop_get_hash', 'ShopUsersController@getHash');
        Route::post('shop_change_password', 'ShopUsersController@changePassword');
    });

});

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/