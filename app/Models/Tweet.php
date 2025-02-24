<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'media_path'];

    protected $casts = [
        'likes_count' => 'integer',
        'retweets_count' => 'integer',
    ];

    protected $appends = ['is_retweeted'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes')
            ->withTimestamps();
    }

    public function retweets(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'retweets')->withTimestamps();
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_tweet');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getIsRetweetedAttribute()
    {
        if (!auth()->check()) {
            return false;
        }
        return $this->retweets()->where('user_id', auth()->id())->exists();
    }
} 