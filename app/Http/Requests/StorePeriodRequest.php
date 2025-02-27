<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeriodRequest extends FormRequest
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
        // $table->string('name')->unique(); // Nom unique de la période
        //     $table->string('slug')->unique(); // Slug unique pour l'URL
        //     $table->string('description')->nullable(); // Description optionnelle
        //     $table->enum('type', ['semester', 'trimester'])->default('semester'); // Type de la période (semestre/trimestre)

        //     $table->date('start_date'); // Date de début de la période
        //     $table->date('end_date'); // Date de fin de la période

        //     $table->boolean('is_current')->default(false);
        return [
            'name' => 'required|string|unique:periods,name',
            'description' => 'nullable|string',
            'type' => 'required|in:semester,trimester',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_current' => 'required|boolean',
        ];
    }
}
