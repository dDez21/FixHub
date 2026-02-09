<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
}
