<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserThemeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'primary_color' => $this->primary_color,
            'secondary_color' => $this->secondary_color,
            'background_image_path' => $this->background_image_path,
            'profile_neon_effect' => $this->profile_neon_effect,
            'dark_mode' => $this->dark_mode,
            'user' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 