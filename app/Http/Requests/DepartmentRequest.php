<?php

namespace App\Http\Requests;

use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', $this->method() == 'POST' ? Rule::unique('departments','code') : Rule::unique('departments','code')->ignore($this->department->id)],
            'code' => ['required', 'string', 'min:3', 'max:4', $this->method() == 'POST' ? Rule::unique('departments','code') : Rule::unique('departments','code')->ignore($this->department->id)],
        ];
    }
}
