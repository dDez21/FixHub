<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//home non loggato
Route::get('/', function () {
    return view('guest.home');
})->name('home');


Route::get('/guest/where', function () {
    return view('guest.where');
})->name('where');

Route::get('/guest/catalog', function () {
    return view('guest.catalog');
})->name('catalog');


// utente loggato
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// tecnico
Route::name('tecn.')->prefix('tecn')->middleware(['auth', 'tecn'])->group(function () {

});


// staff
Route::name('staff.')->prefix('staff')->middleware(['auth', 'staff'])->group(function () {

});

// admin
Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function () {

});


require __DIR__.'/auth.php';