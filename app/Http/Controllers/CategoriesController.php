<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;


class CategoriesController extends Controller{


    // mostro tutte le categorie
    public function show(){

        // se staff solo sue categorie
        if (Gate::allows('isStaff')) {
            $allowedCategoryIds = request()->user()->categories()->pluck('categories.id')->all();

            $categories = Category::whereIn('id', $allowedCategoryIds)
                ->orderBy('name')
                ->get();

            $products = Product::whereIn('category_id', $allowedCategoryIds)
                ->orderBy('name')
                ->get();
        } else {
            
            // altri utenti vedono tutto
            $categories = Category::orderBy('name')->get();
            $products   = Product::orderBy('name')->get();
        }

        return view('pages.catalog', compact('categories', 'products'));
    }


    public function search(Request $request){

        //prendo input barra
        $query = trim($request->input('input', ''));
        
        //prende id categoria selezionata, o vuota se nessuna selezionata
        $categoryId = $request->input('category_id', 'all');

        if ($query === '*' || $query === '') {
            $query = '';
        }

        //preparo query
        $productsQuery = Product::query()->orderBy('name');
        

        // se staff solo sue categorie
        if (Gate::allows('isStaff')) {

            //prendo id categorie associate a staff
            $allowedCategoryIds = $request->user()
                ->categories()
                ->pluck('categories.id')
                ->all();

            $productsQuery->whereIn('category_id', $allowedCategoryIds);


            //se provo a filtrare categoria non sua da vuoto
            if ($categoryId !== 'all' && !in_array((int) $categoryId, $allowedCategoryIds, true)) {
                return response()->json([]);
            }

        } 
        
        //categoria selezionata
        if ($categoryId !== 'all') {
            $productsQuery->where('category_id', $categoryId);
        }

        
        //input non vuoto
        if ($query !== '') {            

            //verifico e rimuovo eventuale *
            $hasWildcard = str_ends_with($query, '*');
            $term = trim(rtrim($query, '*'));

            
            if ($term !== '') {
                
                // metto in sicurezza eventuali caratteri speciali
                $term = preg_quote($term, '/');

                //ricerca parola parziale
                if ($hasWildcard) {
                    $productsQuery->where('description', 'regexp', '[[:<:]]' . $term);
                }

                //ricerca parola intera
                else {
                    $productsQuery->where('description', 'regexp', '[[:<:]]' . $term . '[[:>:]]');
                } 
            }
        }

        $products = $productsQuery->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image_url' => $product->photo
                    ? asset('storage/images/' . $product->photo)
                    : asset('images/noPhoto.png'),
                'show_url' => route('product', $product),
            ];
        });

        return response()->json($products);
    }
}

