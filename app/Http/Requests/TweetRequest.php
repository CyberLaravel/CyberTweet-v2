<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TweetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:280'],
            'media_path' => 'nullable|string|max:255',
            'hashtags' => ['sometimes', 'array'],
            'hashtags.*' => ['string', 'max:50']
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Tweet content is required',
            'content.max' => 'Tweet cannot exceed 280 characters',
            'hashtags.*.max' => 'Hashtag cannot exceed 50 characters'
        ];
    }
} 