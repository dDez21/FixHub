<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Malfunction;


class MalfunctionsController extends Controller
{

    // mostro malfunzionamenti prodotto
    public function show(Product $product)
    {

        $user = request()->user();
        $role = $user?->role;
        $isStaff = ($role === 'staff');
        
        $malfunctions = $product->malfunctions()->orderBy('created_at', 'desc')->get();
        return view('pages.products.malfunctions', compact('product', 'malfunctions', 'isStaff'));
    }


    //vado a pagina nuovo malfunzionamento
    public function create(Product $product){
        
        //fornisco elenco prodotti
        $products = Product::orderBy('name')->get();
        return view('pages.products.createMalfunction', compact('product', 'products'));
    }


    // salvo nuovo malfunzionamento
    public function store(Request $request){
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        Malfunction::create($data);

        return redirect()->route('staff.products.malfunctions', ['product' => $data['product_id']])->with('success', 'Malfunzionamento creato.');    
    }
}
