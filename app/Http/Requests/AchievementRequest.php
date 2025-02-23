<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchievementRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Add any authorization logic if needed
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon_path' => 'nullable|string',
            'rarity' => 'required|in:common,rare,legendary',
            'category' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Achievement name is required',
            'description.required' => 'Achievement description is required',
            'rarity.in' => 'Invalid rarity level',
        ];
    }
} 