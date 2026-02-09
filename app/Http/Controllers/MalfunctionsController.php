<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Malfunction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
    public function store(Request $request, Product $product){
        
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
        ]);

        $data['product_id'] = $product->id;
        Malfunction::create($data);

        return redirect()->route('staff.products.malfunctions', $product)->with('success', 'Malfunzionamento creato.');    
    }


    //vado a modifica malfunzionamento
    public function edit(Product $product, Malfunction $malfunction){

        abort_unless($malfunction->product_id === $product->id, 404);
        $products = Product::orderBy('name')->get();
        return view('pages.products.editMalfunction', [
            'product' => $product,
            'malf' => $malfunction,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Product $product, Malfunction $malfunction){

        abort_unless($malfunction->product_id === $product->id, 404);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'solution' => 'required|string',
        ]);

        $malfunction->update($data);

        return redirect()->route('staff.products.malfunctions', $product)->with('success', 'Malfunzionamento modificato.');    
    }


    //elimino malfunzionamento
    public function deleteConfirm(Product $product, Malfunction $malfunction)
    {
        abort_unless($malfunction->product_id === $product->id, 404);

        return view('pages.products.deleteMalfunction', [
            'product' => $product,
            'malf' => $malfunction,
        ]);
    }

    public function delete(Product $product, Malfunction $malfunction): RedirectResponse
    {
        abort_unless($malfunction->product_id === $product->id, 404);

    DB::transaction(function () use ($malfunction) {
        $malfunction->delete();
    });

    return redirect()
        ->route('staff.products.malfunctions', $product)
        ->with('success', 'Malfunzionamento eliminato.');
    }
}
