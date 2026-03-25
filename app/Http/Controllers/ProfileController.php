<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    // apre pagina profilo utente
    public function show(Request $request): View
    {
        $user = $request->user()->load('categories:id,name');
    
        // carico relazioni solo se è tecnico
        if (Gate::allows('isTech')) {
            $user->load([
                'tech.center.city:id,name',
            ]);
        }

        return view('profile.profile', compact('user'));
    }

    
}
