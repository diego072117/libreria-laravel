<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategorieController;

// Rutas User
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function(){

    Route::get('/GetAllUsers', 'getAllUsers');//->GET trae data
    Route::get('/GetAnUser/{user}', 'getAnUser');//->GET trae data por id

    Route::get('/GetAllUsersWithLends', 'getAllUsersWithLends');//->GET trae data
    Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');//->GET trae data por id
   

    Route::post('/CreateUser', 'createUser');//->POST crea data
    Route::put('/UpdateUser/{user}', 'updateUsers');//->PUT actualza data
    Route::delete('/DeleteUser/{user}', 'deleteUsers');//->DELETE elimina data

});

//Rutas Lend
Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function(){
    Route::post('/CreateLend', 'createLend');

});

//Rutas Authors
Route::group(['prefix' => 'Authors', 'controller' => AuthorController::class], function(){
    Route::get('/GetAllAuthors', 'getAllAuthors');//->GET trae data
    Route::get('/GetAnAuthor/{author}', 'getAnAuthor');//->GET trae data por id
    Route::post('/CreateAuthor', 'createAuthor');//->POST crea data
    Route::put('/UpdateAuthors/{author}', 'updateAuthors');//->PUT actualza data
    Route::delete('/DeleteAuthors/{author}', 'deleteAuthors');//->DELETE elimina data


});

//Rutas Categories
Route::group(['prefix' => 'Categories', 'controller' => CategorieController::class], function(){
    Route::get('/GetAllCategories', 'getAllCategories');//->GET trae data
    Route::get('/GetAnCategorie/{categorie}', 'getAnCategorie');//->GET trae data por id
    Route::post('/CreateCategorie', 'createCategorie');//->POST crea data
    Route::put('/UpdateCategories/{categorie}', 'updateCategories');//->PUT actualza data
    Route::delete('/DeleteCategories/{categorie}', 'deleteCategories');//->DELETE elimina data


});

//Rutas Books
Route::group(['prefix' => 'Books', 'controller' => BookController::class], function(){
    Route::get('/GetAllBooks', 'getAllBooks');//->GET trae data
    Route::get('/GetAnBook/{book}', 'getAnBook');//->GET trae data por id
    Route::post('/CreateBook', 'createBook');//->POST crea data
    Route::put('/UpdateBooks/{book}', 'updateBooks');//->PUT actualza data
    Route::delete('/DeleteBooks/{book}', 'deleteBooks');//->DELETE elimina data


});



