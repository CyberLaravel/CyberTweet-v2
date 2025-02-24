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
            'username' => $this->username,
            'email' => $this->email,
            'profile_photo_url' => $this->profile_photo_url,
            'bio' => $this->bio,
            'location' => $this->location,
            'website' => $this->website,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'followers_count' => $this->whenLoaded('followers', fn() => $this->followers->count()),
            'following_count' => $this->whenLoaded('following', fn() => $this->following->count()),
            'tweets' => TweetResource::collection($this->whenLoaded('tweets')),
            'theme' => new UserThemeResource($this->whenLoaded('theme')),
            'achievements' => AchievementResource::collection($this->whenLoaded('achievements')),
        ];
    }
} 