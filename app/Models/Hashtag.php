<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Hashtag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $appends = ['tweets_count'];

    public function tweets(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'hashtag_tweet');
    }

    public function users()
    {
        return $this->hasManyThrough(
            User::class,
            Tweet::class,
            'id', // Foreign key on tweets table...
            'id', // Foreign key on users table...
            'id', // Local key on hashtags table...
            'user_id' // Local key on tweets table...
        );
    }

    // Accessor for tweets count
    public function getTweetsCountAttribute()
    {
        return $this->tweets()->count();
    }

    // Alternative method to get tweets count
    public function countTweets()
    {
        return DB::table('hashtag_tweet')
            ->where('hashtag_id', $this->id)
            ->count();
    }

    // Use the name as the route key
    public function getRouteKeyName()
    {
        return 'name';
    }
} 