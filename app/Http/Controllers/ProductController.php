<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SaveProductRequest;



class ProductController extends Controller
{
    // mostro dati del prodotto ricevuto
    public function show(Product $product, Request $request ){
        
        
        //membro loggato: staff
        if (Gate::allows('isStaff')) {
            $allowedCategoryIds = $request->user()->categories()->pluck('categories.id')->all();
            abort_unless(in_array($product->category_id, $allowedCategoryIds), 403);
        }

        $product->load('category');

        return view('pages.product', compact('product'));
    }


    // vado a pagina crea prodotto
    public function create(){

        // prendo tutte le categorie e le restituisco
        $categories = Category::orderBy('name')->get();
        return view('pages.admin.product.createProduct', compact('categories'));
    }


    // salvo nuovo prodotto
    public function store(SaveProductRequest $request){


        dd(Storage::disk('public')->put('products/test.txt', 'ciao'));
    }


    // vado a modifica prodotto
    public function edit(Product $product){

        $categories = Category::orderBy('name')->get();
        return view('pages.admin.product.editProduct', compact('product', 'categories'));
    }


    // salvo modifiche prodotto
    public function update(SaveProductRequest $request, Product $product)
{
    $data = $request->validated();

    if ($request->boolean('remove_photo')) {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }
        $data['photo'] = null;
    }

    if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $data['photo'] = $request->file('photo')->store('products', 'public');
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
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
    });

    return redirect()->route('catalog')->with('success', 'Prodotto eliminato.');
}
}