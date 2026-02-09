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

    //dettagli staff
    Route::get('/users/{user}/staff', [UsersController::class, 'staff'])
    ->name( 'users.staff');


    //crea utente
    Route::get('/users/create', [UsersController::class, 'create'])
    ->name('users.createUser');

    Route::post('/users', [UsersController::class, 'store'])->name('users.store');


    //modifica dati utente
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.editUser');

    Route::put('/users/{user}', [UsersController::class, 'update'])
    ->name('users.update');


    //elimina utente
    Route::get('/users/{user}/delete', [UsersController::class, 'deleteConfirm'])
    ->name('users.deleteConfirm');

    Route::delete('/users/{user}', [UsersController::class, 'delete'])
    ->name('users.delete');



    //crea prodotto
    Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.createProduct');

    Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');


    //modifica prodotto
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->name('products.editProduct');

    Route::put('/products/{product}', [ProductController::class, 'update'])
    ->name('products.update');


    //elimina prodotto
    Route::get('/products/{product}/delete', [ProductController::class, 'deleteConfirm'])
    ->name('products.deleteConfirm');

    Route::delete('/products/{product}', [ProductController::class, 'delete'])
    ->name('products.delete');
});


require __DIR__.'/auth.php';