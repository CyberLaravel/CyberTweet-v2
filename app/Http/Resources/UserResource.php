<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'bio' => $this->bio,
            'location' => $this->location,
            'website' => $this->website,
            'followers_count' => $this->followers_count,
            'following_count' => $this->following_count,
            'tweets' => TweetResource::collection($this->whenLoaded('tweets')),
            'theme' => new UserThemeResource($this->whenLoaded('theme')),
            'achievements' => AchievementResource::collection($this->whenLoaded('achievements')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 