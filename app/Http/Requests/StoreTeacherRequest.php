<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'gender' => 'required|in:male,female',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|exists:teachers,email',
            'phone_number' => 'required|exists:teachers,phone',
            'address' => 'nullable|string',
            'cni' => 'required|exists:teachers,cni',
            'birth_date' => 'required|date',
            'medical_condition' => 'nullable|string',
            'social_security_number' => 'nullable|string',
            'cni_expiry_date' => 'nullable|date',
            'speciality' => 'nullable|string',
            'qualification' => 'nullable|string',
            'hire_date' => 'required|date',
            'religion' => 'nullable|string',

            'marrital_status' => 'required|in:married,single,divorced,fianced,other',
            'status' => 'required|in:active,inactive',
            'biography' => 'nullable|string',
            'is_on_leave' => 'required|boolean',
            'leave_start_date' => 'nullable|date',
            'leave_end_date' => 'nullable|date',
        ];
    }
}
