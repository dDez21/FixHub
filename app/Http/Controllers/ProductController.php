<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;


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
        return view('pages.admin.product.createProduct', compact('categories'));
    }


    // salvo nuovo prodotto
    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => ['nullable','file','mimes:jpg,jpeg,png,webp','max:4096'],
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
        return view('pages.admin.product.editProduct', compact('product', 'categories'));
    }


    // salvo modifiche prodotto
    public function update(Request $request, Product $product){
        error_log('errore foto');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => ['nullable','file','mimes:jpg,jpeg,png,webp','max:4096'],
            'category_id' => 'required|exists:categories,id',
            'use_techniques'=> 'required|string',
            'installation'=> 'required|string',
        ]);


        //se carico nuova foto cancello vecchia
        if ($request->hasFile('photo')) {

            
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
           
            $data['photo'] = $request->file('photo')->store('products', 'public');

        //non carico nuova foto ma rimuovo foto
        } elseif ($request->boolean('remove_photo')) {

            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $data['photo'] = null;

        // non faccio nulla sulla foto
        } else {
            unset($data['photo']);
        }
            

        $product->update($data);

        return redirect()->route('product', $product)->with('success', 'Prodotto aggiornato.');
    }



    //elimino prodotto
    public function deleteConfirm(Product $product)
    {
        return view('pages.admin.product.deleteProduct', compact('product'));
    }

    public function delete(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {

            // elimina foto da storage (se esiste)
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            // elimina record dal DB
            $product->delete();
        });

        return redirect()->route('catalog')->with('success', 'Prodotto eliminato.');
    }
}