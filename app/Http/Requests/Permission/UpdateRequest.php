<?php
namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('permission') ?? $this->route('id');
        return [
            'module' => 'required|string|max:255|unique:permissions,module,' . $id,
        ];
    }
}


