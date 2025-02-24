<?php

namespace Database\Factories;

use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Factories\Factory;

class HashtagFactory extends Factory
{
    protected $model = Hashtag::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'tweets_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
} 