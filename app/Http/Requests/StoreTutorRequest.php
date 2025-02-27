<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorRequest extends FormRequest
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
            'type' => 'required|in:father,mother,sister,brother,other',
            'other_type' => 'nullable|required_if:type,other|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|exists:tutors,email',
            'phone_number' => 'required|exists:tutors,phone',
            'address' => 'nullable|string',
            'cni' => 'required|exists:tutors,cni',
            'nationality_id' => 'required|exists:countries,id',
            'birth_date' => 'required|date',
            'cni_expiry_date' => 'nullable|date',
            'job' => 'nullable|string',
            'profile_image_url' => 'nullable|image',
            'joining_date' => 'required|date',

            'status' => 'required|in:active,inactive',
        ];
    }
}
