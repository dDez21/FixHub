<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tech;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewUserController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'surname' => ['required','string','max:255'],
            'username' => ['required','string','max:255','unique:users,username'],
            'password' => ['required','string','min:6'],
            'role' => ['required','in:tech,staff,admin'],

            // solo tech
            'birth_date' => ['required_if:role,tech','date'],
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