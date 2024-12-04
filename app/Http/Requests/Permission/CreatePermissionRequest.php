<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always true, since anyone can create a permission.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the create permission request.
     *
     * @return array<string, array<string|int>> Validation rules for permission fields.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'unique:permissions,name', 'min:3', 'max:255'],
        ];
    }
}
