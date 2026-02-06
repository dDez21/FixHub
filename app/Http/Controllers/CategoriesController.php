<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Product;


class CategoriesController extends Controller{

    // mostro tutte le categorie
    public function show(){

        $categories = Category::orderBy('name')->get(); //prendo tutte le categorie
        $products = Product::orderBy('name')->get(); //prendo tutte le categorie
        
        return view('pages.catalog', compact('categories', 'products')); //passo le categorie e i prodotti alla vista        

    }


}