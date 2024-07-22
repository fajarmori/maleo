<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliverynoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sender' => ['required'],
            'nameSender' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'phoneSender' => ['required', 'numeric', 'min_digits:10', 'max_digits:15'],
            'recipient' => ['required'],
            'nameRecipient' => ['required', 'string', 'max:255', "regex:/^[\w\s.']*$/"],
            'phoneRecipient' => ['required', 'numeric', 'min_digits:10', 'max_digits:15'],
            'via' => ['required', 'string', 'max:255', "regex:/^[\w\s.,'()-\/]*$/"],
        ];
    }
}