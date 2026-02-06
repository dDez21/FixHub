<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // mostro dati del prodotto ricevuto
    public function show(Product $product){

        // ottengo categoria prodotto
        $product->load('category');

        return view('pages.product', compact('product'));
    }
}
