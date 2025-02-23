<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'notification_id' => 'sometimes|exists:notifications,id'
        ];
    }

    public function messages(): array
    {
        return [
            'notification_id.exists' => 'Invalid notification',
        ];
    }
} 