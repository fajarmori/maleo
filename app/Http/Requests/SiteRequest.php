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
            'name' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/", $this->method() == 'POST' ? Rule::unique('sites','name') : Rule::unique('sites','name')->ignore($this->site->id)],
            'code' => ['required', 'string', 'min:3', 'max:4', "regex:/^[\w]*$/", $this->method() == 'POST' ? Rule::unique('sites','code') : Rule::unique('sites','code')->ignore($this->site->id)],
            'owner' => ['required', 'string', 'max:255', "regex:/^[\w\s.,'\-()]*$/"],
            'district' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'regency' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'province' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'description' => ['required', 'string', 'min:5', "regex:/^[\w\s.,'\-()]*$/"],
        ];
    }
}