<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Center;

class CenterController extends Controller{

    //mostro elenco centri
    public function show(){

        $centers = Center::orderBy('name')->get(); //prendo tutti i centri
        
        return view('pages.where', compact('centers')); //passo i centri alla vista
    }

}