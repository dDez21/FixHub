<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $this->app->useLangPath(base_path('lang'));
        
        /* ricavo il livello di autenticazione */
        View::composer('*', function ($view) {
        $role = auth()->check() ? auth()->user()->role : 'guest'; /* verifico login */
        $links = config("level.$role") ?? config("level.guest"); /* prendo elementi in base al livello di login*/
        $view->with('navLinks', $links);
        $view->with('navRole', $role); 
    });
    }
}
