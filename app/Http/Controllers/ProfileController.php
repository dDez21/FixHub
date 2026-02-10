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
        $isStaff = $user->role === 'staff';
        $user->load('categories:id,name');

        // carico relazioni solo se è tecnico
        if ($isTech) {
            $user->load([
                'tech.center.city:id,name',
            ]);
        }

        return view('profile.profile', compact('user', 'isTech', 'isStaff'));
    }

    
}
