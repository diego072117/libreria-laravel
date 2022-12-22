<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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

Route::get('/', [BookController::class,'showHomeWithBooks'])->name('home');

Route::group(['prefix'=>'Users','controller' => UserController::class], function(){

    // users
    Route::get('/','showAllUsers')->name('users');
    
    Route::get('/CreateUser','showCreateUser')->name('user.create');
    Route::post('/CreateUser','createUser')->name('user.create.post');

    Route::get('/EditUser/{user}','showEditUser')->name('user.edit');
    Route::put('/EditUser/{user}','updateUsers')->name('user.edit.put');

    Route::delete('/DeletetUser/{user}','deleteUsers')->name('user.delete');

});

Route::group(['prefix'=>'Books','controller' => BookController::class], function(){

  // books
  Route::get('/','showBooks')->name('books');
  
  // Route::get('/CreateUser','showCreateUser')->name('user.create');
  // Route::post('/CreateUser','createUser')->name('user.create.post');

  // Route::get('/EditUser/{user}','showEditUser')->name('user.edit');
  // Route::put('/EditUser/{user}','updateUsers')->name('user.edit.put');

  // Route::delete('/DeletetUser/{user}','deleteUsers')->name('user.delete');

});

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
