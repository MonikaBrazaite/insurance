<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'birth_date' => 'nullable|date|before:today',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Owner name is required.',
            'name.string' => 'Owner name must be text.',
            'name.max' => 'Owner name cannot be longer than 50 characters.',

            'surname.required' => 'Owner surname is required.',
            'surname.string' => 'Owner surname must be text.',
            'surname.max' => 'Owner surname cannot be longer than 50 characters.',

            'phone.string' => 'Phone number must be text.',
            'phone.max' => 'Phone number cannot be longer than 20 characters.',

            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email address cannot be longer than 100 characters.',

            'birth_date.date' => 'Birth date must be a valid date.',
            'birth_date.before' => 'Birth date must be before today.',
        ];
    }
}
