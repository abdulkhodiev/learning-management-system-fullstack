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
            'name' => ['required', 'string', 'unique:roles,name,' . $this->route('role')->id, 'string', 'max:255'],
        ];
    }
}
