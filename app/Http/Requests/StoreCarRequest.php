<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reg_number' => ['required', 'string', 'max:10', 'regex:/^[A-Z0-9-]+$/'],
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'owner_id' => 'required|exists:owners,id',
        ];
    }

    public function messages(): array
    {
        return [
            'reg_number.required' => 'License plate number is required.',
            'reg_number.string' => 'License plate must be text.',
            'reg_number.max' => 'License plate cannot be longer than 10 characters.',
            'reg_number.regex' => 'License plate format is invalid (only capital letters, numbers, and dashes allowed).',

            'brand.required' => 'Car brand is required.',
            'brand.string' => 'Car brand must be text.',
            'brand.max' => 'Car brand cannot be longer than 50 characters.',

            'model.required' => 'Car model is required.',
            'model.string' => 'Car model must be text.',
            'model.max' => 'Car model cannot be longer than 50 characters.',

            'owner_id.required' => 'Owner must be selected.',
            'owner_id.exists' => 'Selected owner does not exist.',
        ];
    }
}
