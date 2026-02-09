<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Product;


class CategoriesController extends Controller{

    // mostro tutte le categorie
    public function show(){
        $user = request()->user();
        $role = $user?->role;

        $isAdmin = ($role === 'admin');
        $isStaff = ($role === 'staff');

        // se staff solo sue categorie
        if ($isStaff) {
            $allowedCategoryIds = $user->categories()->pluck('categories.id')->all();

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

        return view('pages.catalog', compact('categories', 'products', 'isAdmin', 'isStaff'));
    }


}