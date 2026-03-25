<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Center;
use App\Models\Category;
use App\Models\Tech;
use App\Http\Requests\SaveUserRequest;

class UsersController extends Controller{

    //mostro elenco utenti
    public function show(){

        $users = User::orderBy('name')->get(); //prendo tutti gli utenti
        
        return view('pages.admin.user.users', compact('users')); //passo gli utenti alla vista
    }


    //prendo dettagli tecnico
    public function tech(User $user){
        

        //controllo diretto per verificare ruolo utente scelto
        abort_unless($user->role === 'tech', 404);
    

        //carico centro associato
        $user->load([
        'tech.center:id,name,address',
        'specializations:id,name'
    ]);

        //js usa richiesta json per ottenere dati da mostrare
        return response()->json([
            'tech' => $user->tech ? [
                'birthdate' => $user->tech->birth_date,
                'center' => $user->tech->center ? [
                'name' => $user->tech->center->name,
                'address' => $user->tech->center->address,
            ] : null,
            'specializations' => $user->tech->specializations->pluck('name')->all(),
        ] : null,
        ]);
    }


    //categorie staff
    public function staff(User $user)
    {
        //controllo diretto per verificare ruolo utente scelto
        abort_unless($user->role === 'staff', 404);

        $user->load('categories:id,name');

        return response()->json([
            'staff' => [
                'categories' => $user->categories->pluck('name')->values(),
            ],
        ]);
    }


    //vado a pagina crea utente
    public function create(){

        //prendo centri e categorie per riempire form
        $centers = Center::orderBy('name')->get(['id','name','city_id']);
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('pages.admin.user.createUser', compact('centers', 'categories'));
    }



    //immagazzino nuovo utente
    public function store(SaveUserRequest $request){
    
        $data = $request->validated();

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
                Tech::create([
                    'user_id' => $user->id,
                    'center_id' => $data['center_id'] ?? null,
                    'birth_date' => $data['birth_date'],
                    'specializations' => $data['specializations'] ?? null,
                ]);
            }

            //salvo dati staff
            if ($user->role === 'staff') {
                $user->categories()->sync($data['categories'] ?? []);
            }

            if ($user->role === 'admin') {
                $user->categories()->detach();
            }
        });

        return redirect()->route('admin.users')->with('success', 'Utente creato!');
    }


    //prendo dati per pagina modifica utente
    public function edit(User $user){

        $user->load(['tech.center', 'categories']);
        $centers = Center::orderBy('name')->get(['id','name','city_id']);
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('pages.admin.user.editUser', compact('user','centers','categories'));
    }


    //aggiorno dati utente
    public function update(SaveUserRequest $request, User $user)
    {
        $data = $request->validated();

        DB::transaction(function () use ($user, $data) {

            $user->name = $data['name'];
            $user->surname = $data['surname'];
            $user->username = $data['username'];
            $user->role = $data['role'];

            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }

            $user->save();

            if ($user->role === 'tech') {
                Tech::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'center_id' => $data['center_id'] ?? null,
                        'birth_date' => $data['birth_date'],
                        'specializations' => $data['specializations'] ?? null,
                    ]
                );
                $user->categories()->detach();
            } else {
                // se non è tech, elimina profilo tech (se esiste)
                if ($user->tech) {
                    $user->tech->delete();
                }

                // staff: mantiene categorie
                if ($user->role === 'staff') {
                    $user->categories()->sync($data['categories'] ?? []);
                }

                // admin: niente categorie
                if ($user->role === 'admin') {
                    $user->categories()->detach();
                }
            }
        });

        return redirect()->route('admin.users')->with('success', 'Utente aggiornato!');
    }

    public function deleteConfirm(User $user)
    {
        return view('pages.admin.user.deleteUser', compact('user'));
    }

    public function delete(User $user): RedirectResponse
    {
        DB::transaction(function () use ($user) {
            

            if ($user->tech) {
                $user->tech->delete();
            }

            if ($user->role === 'staff') {
                $user->categories()->detach();
            }

            $user->delete();
        });

        return redirect()->route('admin.users')->with('success', 'Utente eliminato!');
    }
}