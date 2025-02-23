<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'actor' => new UserResource($this->whenLoaded('actor')),
            'data' => $this->data,
            'read_at' => $this->read_at,
            'neon_intensity' => $this->neon_intensity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 