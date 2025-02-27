<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'gender' => 'required|in:male,female',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|exists:students,email',
            'phone_number' => 'required|exists:students,phone',
            'address' => 'nullable|string',
            'cni' => 'nullable|exists:students,cni',
            'matricule' => 'required|exists:students,matricule',
            'birth_date' => 'required|date',
            'medical_condition' => 'nullable|string',
            'social_security_number' => 'nullable|string',
            'cni_expiry_date' => 'nullable|date',
            'graduation_date' => 'nullable|date',
            'previous_school' => 'nullable|string',
            'canteen_status' => 'required|boolean',
            'date_of_admission' => 'nullable|date',
            'religion' => 'nullable|string',
            'scholarship_status' => 'required|in:yes,no',
            'performance_grade' => 'nullable|string',
            'club_id' => 'nullable|exists:clubs,id',
            'is_boarder' => 'required|boolean',
            'has_medical_insurance' => 'required|boolean',
            'special_needs' => 'nullable|string',
            'is_enabled_for_canteen' => 'required|boolean',
            'is_enabled_for_transport' => 'required|boolean',
            'bus_id' => 'nullable|exists:buses,id',
            'nationality_id' => 'required|exists:countries,id',
            'place_of_birth_id' => 'required|exists:countries,id',
            'profile_image_url' => 'nullable|image',
            'joining_date' => 'required|date',
            'status' => 'required|in:active,inactive,graduated',
            'joining_class_id' => 'required|exists:class_rooms,id'
        ];
    }
}
