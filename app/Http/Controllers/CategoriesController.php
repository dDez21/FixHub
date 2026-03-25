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

        //prendo ricerca inserita
        $query = trim($request->input('input', ''));
        
        //prende id categoria selezionata, o vuota se nessuna selezionata
        $categoryId = $request->input('category_id', '');

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

            if ($categoryId !== '' && !in_array((int) $categoryId, $allowedCategoryIds, true)) {
                return response()->json([]);
            }

        } 
        
        if ($categoryId !== '') {
            $productsQuery->where('category_id', $categoryId);
        }

        
        //query non vuota
        if ($query !== '') {            
            $term = trim(rtrim($query, '*'));

            if ($term !== '') {
                 if (str_ends_with($term, '*')) {
                    $term = trim(rtrim($term, '*'));
                    $productsQuery = Product::where('description', 'regexp', '[[:<:]]' . $term)->get();
                }
                // Ricerca esatta (match parola intera nella descrizione)
                else {
                    $productsQuery = Product::where('description', 'regexp', '[[:<:]]' . $term . '[[:>:]]')->get();
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

