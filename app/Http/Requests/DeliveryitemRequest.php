<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryitemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', "regex:/^[\w.]*$/"],
            'name' => ['required', 'string', "regex:/^[\w\s.,':+\/\"()\-@&]*$/"],
            'quantity' => ['required', 'numeric', "regex:/^[\d.]*$/"],
            'unit' => ['required', 'string', "regex:/^[\w]*$/"],
            'bale' => ['nullable', 'string', "regex:/^[\w\s\-]*$/"],
            'price' => ['nullable', 'numeric', "regex:/^[\d]*$/"],
            'weight' => ['required', 'numeric', "regex:/^[\d.]*$/"],
        ];
    }
}


