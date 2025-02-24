<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'tweet_id' => Tweet::factory(),
            'content' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
} 