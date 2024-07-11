<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'nik' => ['required', 'numeric', 'min_digits:16', 'max_digits:16', $this->method() == 'POST' ? Rule::unique('employees','nik') : Rule::unique('employees','nik')->ignore($this->employee->id)],
            'born' => ['required', 'string', 'max:255', "regex:/^[\w\s']*$/"],
            'birthday' => ['required', 'date'],
            'phone' => ['required', 'numeric', 'min_digits:10', 'max_digits:15'],
            'address' => ['required', "regex:/^[\w\s.']*$/"],
        ];
    }
}
