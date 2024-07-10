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
            'nameSender' => ['required', 'string', 'max:255'],
            'phoneSender' => ['required'],
            'recipient' => ['required'],
            'nameRecipient' => ['required', 'string', 'max:255'],
            'phoneRecipient' => ['required'],
            'via' => ['required', 'string', 'max:255'],
        ];
    }
}
