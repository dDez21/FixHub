<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // blocco se non loggato
        if (!auth()->check()) {
            abort(401);
        }

        $userRole = strtolower((string) auth()->user()->role);
        $roles = array_map(fn($r) => strtolower(trim($r)), $roles);


        if (!in_array($userRole, $roles, true)) {
            abort(403);
        }

        return $next($request);
    }









}