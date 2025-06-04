<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'contact_number' => 'required|string|max:15',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'You have already registered to this event',
        ];
    }
}
