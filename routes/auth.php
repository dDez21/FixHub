<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;


/* utente non loggato */
Route::middleware('guest')->group(function () {


    /* vado al login */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    /* autentica utente */
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});


/* utente loggato */
Route::middleware('auth')->group(function () {

    /* form ppw */
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    /* conferma ppw */
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    /* aggiorna ppw */
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    /* logout */
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
