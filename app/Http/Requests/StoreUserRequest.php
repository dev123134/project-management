<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

        'email' => 'required|email|unique:users,email',

        'password' => 'required|min:8|confirmed',

        'role' => 'required|in:admin,freelancer,employee,client',

        'status' => 'required|in:active,inactive',

    ];
}
public function messages(): array
{
    return [

        'name.required' => 'Please enter full name.',

        'email.required' => 'Please enter email address.',

        'email.unique' => 'This email already exists.',

        'password.required' => 'Please enter password.',

        'password.confirmed' => 'Password confirmation does not match.',

        'role.required' => 'Please select role.',

        'status.required' => 'Please select status.',

    ];
}
}
