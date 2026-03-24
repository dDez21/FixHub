<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCenterRequest extends FormRequest
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

        //prende dalla route il centro selezionato, se siamo in create il valore è vuoto
        $center = $this->route('center');

        $phoneRule = Rule::unique('centers', 'phone');
        $emailRule = Rule::unique('centers', 'email');


        //ignoro queste regole solo per il singolo centro, evita di inserire dati di altri centri
        if ($center) {
            $phoneRule = $phoneRule->ignore($center->id);
            $emailRule = $emailRule->ignore($center->id);
        }

        return [
            
            'name' => [
                'required',
                'string',
                'max:255'],

            'phone' => [
                'required',
                'regex:/^[0-9]{10}$/',
                $phoneRule,
            ],

            'email' => [
                'required',
                'max:255',
                Rule::email()
                    ->rfcCompliant(strict: false)
                    ->validateMxRecord(),
                $emailRule,
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


    //messaggi di errore personalizzati
    public function messages(): array
    {
        return [
            'phone.unique' => 'Questo numero di telefono è già associato a un altro centro.',
            'email.unique' => 'Questa email è già associata a un altro centro.',
        ];
    }
}
