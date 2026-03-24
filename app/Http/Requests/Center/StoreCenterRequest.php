<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCenterRequest extends FormRequest
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
        return [
            
            'name' => [
                'required',
                'string',
                'max:255'],

            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/',
                Rule::unique('centers', 'phone'),
            ],

            'email' => [
                'required',
                'max:255',
                Rule::email()
                    ->rfcCompliant(strict: false)
                    ->validateMxRecord(),
                Rule::unique('centers', 'email'),
            ],

            'region_id' => [
                'required', 
                'exists:regions,id'],

            'province_id' => [
                'required',
                Rule::exists('provinces', 'id')
                    ->where(fn ($q) => $q->where('region_id', $this->input('region_id'))),
            ],

            'city_id' => [
                'required',
                Rule::exists('cities', 'id')
                    ->where(fn ($q) => $q->where('province_id', $this->input('province_id'))),
            ],

            'street' => [
                'required',
                'string',
                'max:160'
            ],

            'civic' => [
                'nullable',
                'string',
                'max:20'
            ],

        ];
    }


    //preparo dati prima di validazione togliendo possibili errori
    protected function prepareForValidation(): void{
        $this->merge([
            'email' => strtolower(trim((string) $this->email)),
            'name' => trim((string) $this->name),
            'street' => trim((string) $this->street),
            'civic' => $this->filled('civic') ? trim((string) $this->civic) : null,
        ]);
    }
}
