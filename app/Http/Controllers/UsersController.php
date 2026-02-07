<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class UsersController extends Controller{

    //mostro elenco utenti
    public function show(){

        $users = User::orderBy('name')->get(); //prendo tutti gli utenti
        
        return view('pages.admin.users', compact('users')); //passo gli utenti alla vista
    }

    //prendo dettagli tecnico
    public function tech(User $user){
        
        abort_unless($user->role === 'tech', 404); //utente non è tecnico
    

        //carico centro e categorie tecnico
        $user->load([
            'tech.center:id,name',
            'tech.categories:id,name'
        ]);

        $tech = $user->tech;

        return response()->json([
            'tech' => $tech ? [
                'center' => $tech->center?->name,
                'categories' => $tech->categories->pluck('name')->values(),
            ] : null,
        ]);
    }

}