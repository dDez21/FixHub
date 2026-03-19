<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
    }
}
