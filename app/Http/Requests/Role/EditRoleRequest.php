<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class EditRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:role,name,' . $this->route('role')->id, 'string', 'max:255'],
            'permissions'=>['required', 'array'],
        ];
    }
}
