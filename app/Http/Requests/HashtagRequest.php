<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HashtagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:hashtags,name',
            'tweets_count' => 'sometimes|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Hashtag name is required',
            'name.unique' => 'This hashtag already exists',
        ];
    }
} 