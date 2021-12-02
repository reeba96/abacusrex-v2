<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale(),
                 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'admin' ]], function() {

    Route::group(['prefix' => 'admin'], function() {

           
      /*  Route::post('login', [
            'uses' => 'AuthController@login',
            'as' => 'postLogin'
        ]);*/



        Route::group([ 'prefix' => 'access'], function() {

            Route::group([
                'prefix' => 'countries',
            ], function () {
                Route::get('/', 'CountriesController@index')
                     ->name('countries.country.index');
                Route::get('/create','CountriesController@create')
                     ->name('countries.country.create');
                Route::get('/show/{countries}','CountriesController@show')
                     ->name('countries.country.show')->where('id', '[0-9]+');
                Route::get('/{countries}/edit','CountriesController@edit')
                     ->name('countries.country.edit')->where('id', '[0-9]+');
                Route::post('/', 'CountriesController@store')
                     ->name('countries.country.store');
                Route::put('countries/{countries}', 'CountriesController@update')
                     ->name('countries.country.update')->where('id', '[0-9]+');
                Route::delete('/countries/{countries}','CountriesController@destroy')
                     ->name('countries.country.destroy')->where('id', '[0-9]+');
            });


            Route::group([
                'prefix' => 'invitations',
            ], function () {
                Route::get('/', 'InvitationsController@index')
                     ->name('invitations.invitation.index');
                Route::get('/create','InvitationsController@create')
                     ->name('invitations.invitation.create');
                Route::get('/show/{invitation}','InvitationsController@show')
                     ->name('invitations.invitation.show')->where('id', '[0-9]+');
                Route::get('/{invitation}/edit','InvitationsController@edit')
                     ->name('invitations.invitation.edit')->where('id', '[0-9]+');
                Route::post('/', 'InvitationsController@store')
                     ->name('invitations.invitation.store');
                Route::put('invitation/{invitation}', 'InvitationsController@update')
                     ->name('invitations.invitation.update')->where('id', '[0-9]+');
                Route::delete('/invitation/{invitation}','InvitationsController@destroy')
                     ->name('invitations.invitation.destroy')->where('id', '[0-9]+');
            });

            Route::group([
                'prefix' => 'roles',
            ], function () {
               // Route::get('/', 'RolesController@index')
                 //   ->name('roles.role.index');

                    Route::get('/', [
                        'as' => 'roles.role.index',
                        'uses' => 'RolesController@index'
                    ]);

               /*     Route::get('/create', [
                        'as' => 'roles.role.create',
                        'uses' => 'RolesController@create'
                    ]);
*/
                Route::get('/create','RolesController@create')
                    ->name('roles.role.create');


                Route::get('/show/{role}','RolesController@show')
                    ->name('roles.role.show');
                Route::get('/{role}/edit','RolesController@edit')
                    ->name('roles.role.edit');
                Route::post('/role/permissions/{role}','RolesController@updatePermissions')
                    ->name('roles.role.permissions.update');
                Route::post('/', 'RolesController@store')
                    ->name('roles.role.store');
                Route::put('role/{role}', 'RolesController@update')
                    ->name('roles.role.update');
                Route::delete('/role/{role}','RolesController@destroy')
                    ->name('roles.role.destroy');



            });

            Route::group([
                'prefix' => 'permissions',
            ], function () {
                Route::get('/', 'PermissionsController@index')
                    ->name('permissions.permission.index');
                Route::get('/create','PermissionsController@create')
                    ->name('permissions.permission.create');
                Route::get('/show/{permissions}','PermissionsController@show')
                    ->name('permissions.permission.show');
                Route::get('/{permissions}/edit','PermissionsController@edit')
                    ->name('permissions.permission.edit');
                Route::post('/', 'PermissionsController@store')
                    ->name('permissions.permission.store');
                Route::put('permissions/{permissions}', 'PermissionsController@update')
                    ->name('permissions.permission.update');
                Route::delete('/permissions/{permissions}','PermissionsController@destroy')
                    ->name('permissions.permission.destroy');
            });


            Route::group([
                'prefix' => 'users',
            ], function () {

                Route::get('/', 'UsersController@index')
                     ->name('users.user.index');




                Route::post('/filter', 'UsersController@index')
                     ->name('users.user.filter');



                Route::get('/create','UsersController@create')
                     ->name('users.user.create');
                Route::get('/show/{user}','UsersController@show')
                     ->name('users.user.show')->where('id', '[0-9]+');
                Route::get('/{user}/edit','UsersController@edit')
                     ->name('users.user.edit')->where('id', '[0-9]+');

                Route::post('/user/permissions/{user}','UsersController@updatePermissions')
                     ->name('users.user.permissions.update');

                Route::post('/user/roles/{user}','UsersController@updateRoles')
                     ->name('users.user.roles.update');

                Route::post('/', 'UsersController@store')
                     ->name('users.user.store');
                Route::put('user/{user}', 'UsersController@update')
                     ->name('users.user.update')->where('id', '[0-9]+');
                Route::delete('/user/{user}','UsersController@destroy')
                     ->name('users.user.destroy')->where('id', '[0-9]+');
                Route::post('/{id}/edit', 'UsersController@changePassword')
                     ->name('users.user.update.password')->where('id', '[0-9]+');
            });

            Route::group([
                'prefix' => 'passport',
            ], function () {
                Route::get('/', 'PassportController@index')->name('access.passport.index');
                Route::get('/create', 'PassportController@create')->name('access.passport.create');
                Route::delete('/token/{id}','PassportController@destroy')
                        ->name('access.passport.destroy');
            });
            Route::get('/', 'AccessController@index');

            Route::get('user-logs', [
                'as' => 'access.user.logs',
                'uses' => 'UserLogsController@index'
            ]);

            Route::get('user-logs/filter-logs', [
                'as' => 'access.filter.user.logs',
                'uses' => 'UserLogsController@index'
            ]);
        });
    });

});