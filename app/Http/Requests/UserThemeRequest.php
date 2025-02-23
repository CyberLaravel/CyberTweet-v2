<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserThemeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'primary_color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'secondary_color' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'background_image_path' => 'nullable|string|max:255',
            'profile_neon_effect' => 'required|in:pulse,glow,none',
            'dark_mode' => 'required|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'primary_color.regex' => 'Primary color must be a valid hex color',
            'secondary_color.regex' => 'Secondary color must be a valid hex color',
            'profile_neon_effect.in' => 'Invalid neon effect selected',
        ];
    }
} 