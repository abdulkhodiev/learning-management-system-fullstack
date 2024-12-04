<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always true, since anyone can update a user.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for updating a user.
     *
     * @return array<string, array<string|int>> Validation rules for user update fields.
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role'=>['required'],
            'password' => ['nullable', 'string', 'min:8', ],
        ];

        if ($this->input('role') === 'mentor') {
            $rules['fields'] = ['nullable', 'string'];
            $rules['experience'] = ['nullable', 'string'];
        }

        return $rules;
    }
}
