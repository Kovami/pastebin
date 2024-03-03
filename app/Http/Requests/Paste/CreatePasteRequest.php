<?php

namespace App\Http\Requests\Paste;

use App\Enums\LanguageEnum;
use App\Enums\VisibilityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePasteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'body' => 'required|string',
            'language' => ['nullable', Rule::enum(LanguageEnum::class)],
            'visibility' => ['required', Rule::enum(VisibilityEnum::class)],
            'expires_at' => 'required|int'
        ];
    }
}
