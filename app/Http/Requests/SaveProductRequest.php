<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //verifico se l'utente che sta eseguendo l'azione sia un admin
        return $this->user()?->can('isAdmin') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required','string'],
            'photo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:4096'],
            'remove_photo' => ['nullable', 'boolean'],
            'category_id' => ['required', 'exists:categories,id'],
            'use_techniques'=> ['required','string'],
            'installation'=> ['required','string'],
        ];
    }
}
