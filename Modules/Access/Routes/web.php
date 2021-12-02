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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'web' ]], function() {

    // Login
    Route::group(['middleware' => 'guest'], function() {

        Route::view('login', 'access::auth.login')->name('login'); 

        Route::view('admin/login', 'access::auth.admin_login')->name('admin.login'); 

        Route::post('login', [
            'uses' => 'AuthController@login',
            'as' => 'postLogin'
        ]);
    
        Route::post('adminLogin', [
            'uses' => 'AuthController@login',
            'as' => 'postAdminLogin'
        ]);
    });

   

  


    // Check email before register account (without invitation link)
    Route::post('emailCheck', 'AuthController@checkEmail')->name('emailCheck');
    
    // Register user (without invitation link)
    Route::post('access/register', 'AuthController@store')->name('postRegister');

    Route::prefix('access')->group(function() {
        Route::group([ 'prefix' => 'auth','namespace' =>'\Modules\Access\Http\Controllers\Auth', 'middleware' => ['hasInvitation']],function() {
        
            Route::get('register', 'RegisterController@showRegistrationForm')->name('access.invitation.register');
            // Route::post('register', 'RegisterController@showRegistrationForm')->name('access.invitation.register');

        });

    });

    // Reset password
    Route::get('password/reset', 'AuthController@resetPassword')->name('password.request');

    // Send reset password email
    Route::post('password/reset', 'AuthController@resetPasswordSendEmail')->name('reset.password.email');

    // Reset password link
    Route::get('reset/password/{id}/{confirmation_code}', 'AuthController@changePasswordForm');

    Route::post('reset/password', 'AuthController@changePassword')->name('new.password');

    /* password reset route : password.request */

     /*   Route::group(['middleware' => 'guest','prefix'=>'auth','namespace' =>'\Modules\Access\Http\Controllers\Auth'], function() {

            Route::get('password/reset',[
                'as' => 'password_reset',
                'uses' => 'ForgotPasswordController@showLinkRequestForm'
            ]); 
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        });      */ 
  
       /* Route::post('register', [
            'uses' => 'AuthController@store',
            'as' => 'postRegister'
        ]);*/

        Route::get('mail', 'AccessController@email_verify');
        /*Route::get('mail', function() {
            return view('admin::admin.email.verify');
        });*/

        Route::get('register/verify/{confirmationCode}', [
            'as' => 'confirmation_path',
            'uses' => 'AuthController@confirm'
        ]);
        Route::post('logins', [
           // 'uses' => 'AuthController@login',
           // 'as' => 'postLogin'
        ]);

    /*    Route::get('register/verify/{confirmationCode}', [
            'as' => 'confirmation_path',
            'uses' => 'AuthController@confirm'
        ]);
       */ 
       
    
});
