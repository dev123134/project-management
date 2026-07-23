<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [

            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user),
            ],

            'role' => 'required|in:admin,freelancer,employee,client',

            'status' => 'required|in:active,inactive',

            'password' => 'nullable|min:8|confirmed',

        ];
    }
    public function messages(): array
{
    return [

        'name.required' => 'Please enter full name.',

        'email.required' => 'Please enter email address.',

        'email.email' => 'Please enter a valid email.',

        'email.unique' => 'This email already exists.',

        'role.required' => 'Please select role.',

        'status.required' => 'Please select status.',

        'password.min' => 'Password must be at least 8 characters.',

        'password.confirmed' => 'Password confirmation does not match.',

    ];
}
}
