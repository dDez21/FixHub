<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // apre pagina profilo utente
    public function show(Request $request): View
    {
        $user = $request->user();
        $isTech = $user->role === 'tech';

        // carico relazioni solo se è tecnico
        if ($isTech) {
            $user->load([
                'tech.center',
                'tech.categories',
            ]);
        }

        return view('profile.profile', [
            'user' => $user,
            'isTech' => $isTech,
        ]);
    }

    
}
