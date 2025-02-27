<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBuildingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:buildings,name', // Raison du blâme, obligatoire, chaîne de caractères, maximum 255 caractères
            'description' => 'required|string', // Date à laquelle le blâme a été attribué, obligatoire, doit être une date valide et ne pas être dans le futur
        ];
    }
}
