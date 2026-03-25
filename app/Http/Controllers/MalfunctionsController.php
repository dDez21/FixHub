<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Malfunction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SaveMalfunctionRequest;


class MalfunctionsController extends Controller
{

    //mostro malfunzionamenti prodotto
    public function show(Product $product)
    {        
        $malfunctions = $product->malfunctions()->orderBy('created_at', 'desc')->get();
        return view('pages.products.malfunctions', compact('product', 'malfunctions'));
    }


    //filtro ricerche malfunzionamenti
    public function search(Product $product, Request $request){

        //prendo input barra di ricerca
        $query = trim($request->input('input', ''));
        $isStaff = Gate::allows('isStaff');
        //preparo query per malf del prodotto selezionato
        $malfsQuery = $product->malfunctions()->orderBy('name');

        if ($query !== '') { 
            
            // metto in sicurezza eventuali caratteri speciali
            $query = preg_quote($query, '/');
            $malfsQuery->where('description', 'regexp', '[[:<:]]' . $query . '[[:>:]]');
        }
        $malfs = $malfsQuery->get()->map(function ($malf) use ($product, $isStaff){
            return [
                'id' => $malf->id,
                'name' => $malf->name,
                'description' => $malf->description,
                'solution' => $malf->solution,
                'edit_url' => $isStaff
                    ? route('staff.products.malfunctions.edit', ['product' => $product, 'malfunction' => $malf])
                    : null,
                'delete_url' => $isStaff
                    ? route('staff.products.malfunctions.deleteConfirm', ['product' => $product, 'malfunction' => $malf])
                    : null,
            ];
        });
        
        return response()->json($malfs);
    }


    //vado a pagina nuovo malfunzionamento
    public function create(Product $product){
        
        $allowedCategoryIds = request()->user()->categories()->pluck('categories.id')->all();

        $products = Product::whereIn('category_id', $allowedCategoryIds)
            ->orderBy('name')
            ->get();

        //fornisco elenco prodotti
        return view('pages.products.createMalfunction', compact('product', 'products'));
    }


    // salvo nuovo malfunzionamento
    public function store(SaveMalfunctionRequest $request, Product $product){
        

        $data = $request->validated();
        $product->malfunctions()->create($data);

        return redirect()->route('staff.products.malfunctions', $product)->with('success', 'Malfunzionamento creato.');    
    }


    //vado a modifica malfunzionamento
    public function edit(Product $product, Malfunction $malfunction){

        abort_unless($malfunction->product_id === $product->id, 404);
        
        $allowedCategoryIds = request()->user()->categories()->pluck('categories.id')->all();

        $products = Product::whereIn('category_id', $allowedCategoryIds)
            ->orderBy('name')
            ->get();

        return view('pages.products.editMalfunction', [
            'product' => $product,
            'malf' => $malfunction,
            'products' => $products,
        ]);
    }

    public function update(SaveMalfunctionRequest $request, Product $product, Malfunction $malfunction){

        abort_unless($malfunction->product_id === $product->id, 404);

        $data = $request->validated();
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
