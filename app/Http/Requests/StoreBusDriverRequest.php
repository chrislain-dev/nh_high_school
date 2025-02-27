<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusDriverRequest extends FormRequest
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
            'type' => 'required|in:driver,helper', // Type doit être "driver" ou "helper"
            'status' => 'required|in:active,inactive', // Statut doit être "active" ou "inactive"
            'gender' => 'required|in:male,female', // Sexe doit être "male" ou "female"
            'first_name' => 'required|string|max:255', // Prénom, obligatoire, chaîne de caractères, max 255 caractères
            'last_name' => 'required|string|max:255', // Nom de famille, obligatoire, chaîne de caractères, max 255 caractères
            'slug' => 'required|string|unique:users,slug|max:255', // Slug, obligatoire, unique dans la table "users", max 255 caractères
            'email' => 'required|email|unique:users,email|max:255', // Email, obligatoire, format email, unique dans la table "users", max 255 caractères
            'phone' => 'nullable|string|max:20', // Téléphone, facultatif, chaîne de caractères, max 20 caractères
            'address' => 'nullable|string|max:255', // Adresse, facultatif, chaîne de caractères, max 255 caractères
            'birth_date' => 'required|date|before_or_equal:today', // Date de naissance, obligatoire, format date, ne doit pas être dans le futur
            'nationality_id' => 'required|exists:countries,id', // Nationalité, obligatoire, doit exister dans la table "countries"
            'birth_place_id' => 'required|exists:countries,id', // Lieu de naissance, obligatoire, doit exister dans la table "countries"
            'profile_image_url' => 'nullable|url|max:255', // URL de l'image de profil, facultatif, format URL, max 255 caractères
            'cni' => 'required|string|unique:users,cni|max:255', // CNI, obligatoire, unique dans la table "users", max 255 caractères
            'salary' => 'nullable|integer|min:0', // Salaire, facultatif, doit être un entier, minimum 0
        ];
    }

}
