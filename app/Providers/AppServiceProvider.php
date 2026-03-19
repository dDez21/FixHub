<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {            

        //gate per admin
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });


        //gate per tecnico
        Gate::define('isTech', function (User $user) {
            return $user->role === 'tech';
        });

        //gate per staff
        Gate::define('isStaff', function (User $user) {
            return $user->role === 'staff';
        });


        //chiamato ogni volta che devo reinderizzare l'header
        View::composer('components.header', function($view){

            $role = 'guest'; //imposto inizialmente il ruolo di guest


            //controllo stato autenticazione
            if (Auth::check()) {
                $role = Auth::user()->role ?? 'guest';
            }


            $navLinks = config( //leggo nella cartella config

                "navigation.$role", config('navigation.guest', []) //in base al livello di autenticazione prendo gli elementi giusti
            );

            $view->with('navLinks', $navLinks); //mando navLink alla view
        });
    }
}
