<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'Users', 'controller' => UserController::class], function(){

    Route::get('/GetAllUsers', 'getAllUsers');//->GET trae data
    Route::get('/GetAnUser/{user}', 'getAnUser');//->GET trae data por id

    Route::get('/GetAllUsersWithLends', 'getAllUsersWithLends');//->GET trae data
    Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');//->GET trae data por id
   

    Route::post('/CreateUser', 'createUser');//->POST crea data
    Route::put('/UpdateUser/{user}', 'updateUsers');//->PUT actualza data
    Route::delete('/DeleteUser/{user}', 'deleteUsers');//->DELETE elimina data

});

Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function(){
    Route::post('/CreateLend', 'createLend');

});




