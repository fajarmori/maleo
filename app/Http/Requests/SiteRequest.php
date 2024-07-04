<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'owner' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'regency' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:5'],
            'code' => ['required', 'string', 'min:3', 'max:4', $this->method() == 'POST' ? Rule::unique('sites','code') : Rule::unique('sites','code')->ignore($this->site->id)],
        ];
    }
}
