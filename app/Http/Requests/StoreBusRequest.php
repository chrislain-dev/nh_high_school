<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusRequest extends FormRequest
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
            'bus_driver_id' => 'required|exists:bus_drivers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'title' => 'required|string|max:255|unique:buses,title',
            'slug' => 'required|string|max:255|unique:buses,slug',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:buses,registration_number',
            'license_plate' => 'required|string|max:255|unique:buses,license_plate',
            'capacity' => 'required|integer|min:1',
        ];
    }
}
