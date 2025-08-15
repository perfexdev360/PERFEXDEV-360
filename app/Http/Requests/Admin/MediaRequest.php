<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'model_type' => ['required', 'string', 'max:255'],
            'model_id' => ['required', 'integer'],
            'collection_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'disk' => ['required', 'string', 'max:255'],
            'size' => ['required', 'integer'],
        ];
    }
}
