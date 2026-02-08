<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Center;
use App\Models\Category;
use App\Models\Tech;

class UsersController extends Controller{

    //mostro elenco utenti
    public function show(){

        $users = User::orderBy('name')->get(); //prendo tutti gli utenti
        
        return view('pages.admin.users', compact('users')); //passo gli utenti alla vista
    }

    //prendo dettagli tecnico
    public function tech(User $user){
        
        abort_unless($user->role === 'tech', 404); //utente non è tecnico
    

        //carico centro e categorie tecnico
        $user->load([
            'tech.center:id,name',
            'tech.categories:id,name'
        ]);

        $tech = $user->tech;

        return response()->json([
            'tech' => $tech ? [
                'center' => $tech->center?->name,
                'categories' => $tech->categories->pluck('name')->values(),
            ] : null,
        ]);
    }

    //vado a pagina crea utente
    public function create(){

        //prendo centri e categorie per riempire form
        $centers = Center::orderBy('name')->get(['id','name','city']);
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('pages.admin.createUser', compact('centers', 'categories'));
    }


    //immagazzino nuovo utente
    public function store(Request $request)
    {
        dd('STORE HIT', $request->all());

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'surname' => ['required','string','max:255'],
            'username' => ['required','string','max:255','unique:users,username'],
            'password' => ['required','string','min:6'],
            'role' => ['required','in:tech,staff,admin'],

            // solo tech
            'birth_date' => ['required_if:role,tech', 'date', 'before_or_equal:today'],
            'center_id' => ['nullable','exists:centers,id'],
            'categories' => ['nullable','array'],
            'categories.*' => ['integer','exists:categories,id'],
        ]);

        DB::transaction(function () use ($data) {
            
            //salvo dati in user
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            //salvo dati tecnico in tech
            if ($user->role === 'tech') {
                $tech = Tech::create([
                    'user_id' => $user->id,
                    'center_id' => $data['center_id'] ?? null,
                    'birth_date' => $data['birth_date'],
                ]);

                $tech->categories()->sync($data['categories'] ?? []);
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'Utente creato!');
    }

}