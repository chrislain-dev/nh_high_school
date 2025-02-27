<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRoomRequest extends FormRequest
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
            'nom' => 'required|string|max:255', // Nom obligatoire, chaîne de max 255 caractères
            'code' => 'required|string|max:50|unique:class_rooms,code', // Code unique, max 50 caractères
            'description' => 'nullable|string|max:1000', // Description facultative, max 1000 caractères
            'capacity' => 'required|integer|min:1|max:100', // Capacité entre 1 et 100 (ajuster selon le besoin)
            'main_teacher_id' => 'nullable|exists:teachers,id', // Doit exister dans la table `teachers`
            'building_id' => 'nullable|exists:buildings,id', // Doit exister dans la table `buildings`
            'class_level_id' => 'required|exists:class_levels,id', // Doit exister dans `class_levels`
        ];
    }
}
