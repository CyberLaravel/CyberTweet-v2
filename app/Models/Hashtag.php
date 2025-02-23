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
} 