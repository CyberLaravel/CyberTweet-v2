<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'media_path' => $this->media_path,
            'likes_count' => $this->likes_count,
            'retweets_count' => $this->retweets_count,
            'user' => new UserResource($this->whenLoaded('user')),
            'likes' => UserResource::collection($this->whenLoaded('likes')),
            'retweets' => UserResource::collection($this->whenLoaded('retweets')),
            'hashtags' => HashtagResource::collection($this->whenLoaded('hashtags')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
} 