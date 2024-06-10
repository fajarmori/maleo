<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OccupationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', $this->method() == 'POST' ? Rule::unique('occupations','name') : Rule::unique('occupations','name')->ignore($this->occupation->id)],
            'department' => ['required','numeric', Rule::exists('departments','id')],
        ];
    }
}
