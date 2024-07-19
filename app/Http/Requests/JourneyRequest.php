<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class JourneyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
            'site' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
            'application' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
            'origin' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
            'destination' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
            'date' => ['required', 'date'],
            'transportation' => ['required', 'string', 'max:255', "regex:/^[\w\s,()]*$/"],
        ];
    }
}
