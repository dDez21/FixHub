<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveUserRequest extends FormRequest
{

    //per vedere se utente loggato ha autorizzazione di svolgere tale azione
    public function authorize(): bool
    {
        //verifico se l'utente che sta eseguendo l'azione sia un admin
        return $this->user()?->can('isAdmin') ?? false;
    }

    

    //regole di validazione
    public function rules(): array
    {

        //prendo dalla route l'utente selezionato, se sono in create il valore è vuoto
        $user = $this->route('user');

        $usernameRule = Rule::unique('users', 'username');

        //ignoro queste regole solo per il singolo utente, evita di inserire dati di altri utenti
        if ($user) {
            $usernameRule = $usernameRule->ignore($user->id);
        }

        return [
            
            'name' => [
                    'required',
                    'string',
                    'max:255'],


            'surname' => [
                    'required',
                    'string',
                    'max:255'],


            'username' => [
                    'required',
                    'string',
                    'max:255',
                    $usernameRule],

            'password' => [
                        $user ? 'nullable' : 'required',
                        'string',
                        'min:6'],

            'role' => [
                'required',
                'in:tech,staff,admin'],


            // solo tech
            'birth_date' => [
                'exclude_unless:role,tech',
                'required',
                'date',
                'before_or_equal:today'],

            'center_id' => [
                'exclude_unless:role,tech',
                'nullable',
                'exists:centers,id'],

            'specializations' => [
                'exclude_unless:role,tech',
                'nullable',
                'string',
                'max:255'],

                
            // solo staff
            'categories' => [
                'exclude_unless:role,staff',
                'nullable',
                'array'],

            'categories.*' => [
                'integer',
                'exists:categories,id'],
        ];
    }


    //preparo dati prima di validazione togliendo possibili errori
    protected function prepareForValidation(): void{
        $this->merge([            
            'name' => trim((string) $this->name),
            'surname' => trim((string) $this->surname),
            'username' => trim((string) $this->username),
        ]);
    }
}