<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class EditPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always true, since anyone can edit permissions.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules for editing a permission.
     *
     * @return array<string, array<string|int>> Validation rules for permission fields.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:permissions,name,' . $this->route('permission')->id,
            ],
        ];
    }
}
