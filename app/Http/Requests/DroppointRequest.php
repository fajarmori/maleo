<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DroppointRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', $this->method() == 'POST' ? Rule::unique('droppoints','name') : Rule::unique('droppoints','name')->ignore($this->droppoint->id)],
            'address' => ['required', 'string'],
            'notes' => ['required', 'string'],
        ];
    }
}
