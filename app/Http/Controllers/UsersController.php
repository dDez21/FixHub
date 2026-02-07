<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Users;

class UsersController extends Controller{

    //mostro elenco utenti
    public function show(){

        $users = Users::orderBy('name')->get(); //prendo tutti gli utenti
        
        return view('pages.users', compact('users')); //passo gli utenti alla vista
    }

}