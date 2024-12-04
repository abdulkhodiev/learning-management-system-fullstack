<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always true, since anyone can register.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules for the registration request.
     *
     * @return array<string, array<string|int>> Validation rules for registration fields.
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'max:255'],
            'last_name'=> ['required', 'last_name'],
            'username' => ['required', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ];
    }
}
