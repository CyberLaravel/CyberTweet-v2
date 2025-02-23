<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'icon_path' => $this->icon_path,
            'rarity' => $this->rarity,
            'category' => $this->category,
            'users_count' => $this->whenCounted('users'),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 