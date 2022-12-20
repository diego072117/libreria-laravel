<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;

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

Route::view('/','home');


Route::group(['controller' => LoginController::class], function(){

    // Login Routes..
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    

    // Logout Routes...
    Route::post('logout', 'logout')->name('logout');

});

Route::group(['controller' => ForgotPasswordController::class], function(){

  // Password Reset Routes...
Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
Route::post('password/email', 'sendResetLinkEmail')->name('password.email');

});

Route::group(['controller' => ResetPasswordController::class], function(){

    
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.update');
  
  });   

Route::group(['controller' => ConfirmPasswordController::class], function(){

    // Password Confirmation Routes...
    Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'confirm');
  
  });    


Route::group(['controller' => VerificationController::class], function(){

    // Email Verification Routes...

Route::get('email/verify', 'show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
Route::post('email/resend', 'resend')->name('verification.resend');
  
  });     







Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
