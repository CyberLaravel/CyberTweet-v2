<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'likes_count' => $this->likes()->count(),
            'comments_count' => $this->comments()->count(),
            'retweets_count' => $this->retweets()->count(),
            'liked' => $request->user() ? $this->likes()->where('user_id', $request->user()->id)->exists() : false,
            'is_retweeted' => $request->user() ? $this->retweets()->where('user_id', $request->user()->id)->exists() : false,
            'hashtags' => $this->hashtags->pluck('name'),
        ];
    }
} 