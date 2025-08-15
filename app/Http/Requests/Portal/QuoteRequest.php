<?php

namespace App\Http\Requests\Portal;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'number' => ['required', 'string', 'max:255'],
            'valid_until' => ['nullable', 'date'],
            'status' => ['sometimes', 'in:draft,sent,approved,rejected,expired'],
        ];
    }
}
