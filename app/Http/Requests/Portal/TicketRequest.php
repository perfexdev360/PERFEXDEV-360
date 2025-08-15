<?php

namespace App\Http\Requests\Portal;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'in:low,normal,high,urgent'],
            'status' => ['sometimes', 'in:open,pending,resolved,closed'],
        ];
    }
}
