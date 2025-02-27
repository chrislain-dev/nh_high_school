<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCLassFeeRequest extends FormRequest
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
            'class_room_id' => 'required|exists:class_rooms,id', // Doit exister dans la table `class_rooms`
            'register_fees' => 'required|numeric|min:0', // Frais d'inscription, nombre positif
            'school_fees' => 'required|numeric|min:0', // Frais scolaires, nombre positif
            'canteen_fees' => 'required|numeric|min:0', // Frais de cantine, nombre positif
            'bus_fees' => 'required|numeric|min:0', // Frais de transport, nombre positif
            'other_fees' => 'required|numeric|min:0', // Autres frais, nombre positif
            'note' => 'nullable|string|max:1000', // Note facultative, max 1000 caractères
        ];
    }
}
