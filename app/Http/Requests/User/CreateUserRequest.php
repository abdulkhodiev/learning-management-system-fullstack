<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ];

        // Add mentor-specific rules if the role is mentor
        if ($this->input('role') === 'mentor') {
            $rules['fields'] = ['nullable', 'string'];
            $rules['experience'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
