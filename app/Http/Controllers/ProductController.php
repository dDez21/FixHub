<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
App\Http\Controllers\Storage;

class ProductController extends Controller
{
    // mostro dati del prodotto ricevuto
    public function show(Product $product, Request $request ){

        $user = $request->user();
        $role = $user?->role;

        $isAdmin = ($role === 'admin');
        $isStaff = ($role === 'staff');
        

        //membro loggato: staff
        if ($isStaff) {
            $allowedCategoryIds = $user->categories()->pluck('categories.id')->all();
            abort_unless(in_array($product->category_id, $allowedCategoryIds), 403);
        }

        $product->load('category');

        return view('pages.product', compact('product', 'isAdmin', 'isStaff'));
    }


    // vado a pagina crea prodotto
    public function create(){

        // prendo tutte le categorie e le restituisco
        $categories = Category::orderBy('name')->get();
        return view('pages.products.create', compact('categories'));
    }


    // salvo nuovo prodotto
    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:4096',
            'category_id' => 'required|exists:categories,id',
            'use_techniques'=> 'required|string',
            'installation'=> 'required|string',
        ]);

        // salvo foto
        if($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('catalog')->with('success', 'Prodotto creato.');
    }


    // vado a modifica prodotto
    public function edit(Product $product){

        $categories = Category::orderBy('name')->get();
        return view('pages.products.edit', compact('product', 'categories'));
    }


    // salvo modifiche prodotto
    public function update(Request $request, Product $product){

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:4096',
            'category_id' => 'required|exists:categories,id',
            'use_techniques'=> 'required|string',
            'installation'=> 'required|string',
        ]);


        if ($request->boolean('remove_photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = null;
        }

        // Se carichi una nuova foto: sostituisci (cancella vecchia)
        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $data['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('product', $product)->with('success', 'Prodotto aggiornato.');
    }
}