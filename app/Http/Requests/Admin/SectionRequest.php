<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_id' => ['required', 'exists:pages,id'],
            'type' => ['required', 'string', 'max:255'],
            'content' => ['array'],
            'order' => ['integer'],
        ];
    }
}
