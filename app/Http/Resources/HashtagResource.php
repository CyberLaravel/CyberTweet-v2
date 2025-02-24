<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HashtagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
            'tweets_count' => $this->tweets_count ?? $this->tweets()->count(),
            'users_count' => $this->users_count ?? $this->users()->count(),
            'likes_count' => $this->likes_count ?? $this->tweets()->withCount('likes')->get()->sum('likes_count'),
            'tweets' => TweetResource::collection($this->whenLoaded('tweets')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 