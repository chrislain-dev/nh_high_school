<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlameRequest extends FormRequest
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
            'student_id' => 'required|exists:students,id', // ID de l'étudiant, obligatoire et doit exister dans la table `students`
            'teacher_id' => 'nullable|exists:teachers,id', // ID de l'enseignant, peut être nul, mais doit exister dans la table `teachers` si renseigné
            'reason' => 'required|string|max:255', // Raison du blâme, obligatoire, chaîne de caractères, maximum 255 caractères
            'date_given' => 'required|date|before_or_equal:today', // Date à laquelle le blâme a été attribué, obligatoire, doit être une date valide et ne pas être dans le futur
            'severity' => 'required|in:minor,major,serious', // Gravité du blâme, obligatoire et doit être l'une des valeurs définies ('minor', 'major', 'serious')
            'resolved' => 'required|boolean', // Si le blâme est résolu ou non, obligatoire, doit être un booléen
            'notes' => 'nullable|string|max:500', // Notes supplémentaires, facultatif, chaîne de caractères, maximum 500 caractères
        ];
    }
}
