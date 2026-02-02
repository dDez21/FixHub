<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;


/* utente non loggato */
Route::middleware('guest')->group(function () {

    /* creo utente */
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    /* creo utente + lo autentico */
    Route::post('register', [RegisteredUserController::class, 'store']);

    /* vado al login */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    /* autentica utente */
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    /* reset ppw */
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    /* invio email per il reset */
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    /* nuova ppw */
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    /* salvo nuova ppw + autenticazione */
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


/* utente loggato */
Route::middleware('auth')->group(function () {

    /* verifica email */
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    /* conferma email */
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    /* reinvia email di verifica */
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

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
