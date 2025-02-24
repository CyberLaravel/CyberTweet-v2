<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Hashtag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the roles and permissions seeder first
        $this->call(RolesAndPermissionsSeeder::class);

        // Create users
        $users = User::factory(50)->create();

        // Create tweets with hashtags
        $tweets = Tweet::factory(200)
            ->sequence(fn ($sequence) => ['user_id' => $users->random()])
            ->create();

        // Create hashtags first
        $hashtagNames = ['cyberpunk', 'tech', 'future', 'neon', 'hacker', 'ai'];
        $hashtags = collect();
        
        foreach ($hashtagNames as $name) {
            $hashtags->push(Hashtag::create(['name' => $name]));
        }

        // Now attach hashtags to tweets using the created hashtag models
        $tweets->each(function ($tweet) use ($hashtags) {
            $tweet->hashtags()->attach(
                $hashtags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Create comments
        Comment::factory(300)
            ->sequence(fn ($sequence) => [
                'user_id' => $users->random(),
                'tweet_id' => $tweets->random(),
            ])
            ->create();

        // Create follows relationships
        $users->each(function ($user) use ($users) {
            $followings = $users->except($user->id)->random(rand(0, 10));
            $user->followings()->attach($followings);
        });

        // Create likes
        $tweets->each(function ($tweet) use ($users) {
            $likers = $users->random(rand(0, 15));
            $tweet->likes()->attach($likers);
        });

        // Create retweets
        $tweets->each(function ($tweet) use ($users) {
            $retweeters = $users->random(rand(0, 5));
            $tweet->retweets()->attach($retweeters);
        });

        // Create bookmarks
        $users->each(function ($user) use ($tweets) {
            $bookmarkedTweets = $tweets->random(rand(0, 10));
            $user->bookmarks()->attach($bookmarkedTweets);
        });
    }
}
