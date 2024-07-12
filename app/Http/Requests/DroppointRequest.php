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
            'name' => ['required', "regex:/^[\w\s]*$/", $this->method() == 'POST' ? Rule::unique('droppoints','name') : Rule::unique('droppoints','name')->ignore($this->droppoint->id)],
            'address' => ['required', 'string', "regex:/^[\w\s.,'\/()-]*$/"],
            'notes' => ['required', 'string', "regex:/^[\w\s.,'\/()-]*$/"],
        ];
    }
}
