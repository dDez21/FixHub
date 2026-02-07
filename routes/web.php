<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

//home non loggato
Route::get('/', function () {
    return view('pages.home');
})->name('home');


//pagina elenco centri
Route::get('/pages/where', [CenterController::class, 'show'])
->name('where');


//pagina catalogo
Route::get('/pages/catalog', [CategoriesController::class,'show'])
->name('catalog');


//pagina prodotto
Route::get('/pages/product/{product}', [ProductController::class,'show'])
->name('product');



// utente loggato, middleware per verificare auth
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile'); //pagina profilo utente
});



// rotte tecnico
Route::prefix('tecn')->name('tecn.')->middleware(['auth', 'role:tech'])->group(function () {

});



// rotte staff
Route::prefix('staff')->name('staff.')->middleware(['auth', 'role:staff'])->group(function () {

});

// rotte admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    //pagina lista utenti
    Route::get('/users', [UsersController::class, 'show'])
    ->name('users');

    //dettagli tecnico
    Route::get('/users/{user}/tech', [UsersController::class, 'tech'])
    ->name('users.tech');
});


require __DIR__.'/auth.php';