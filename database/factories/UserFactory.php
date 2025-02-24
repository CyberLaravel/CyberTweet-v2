<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'bio' => $this->faker->optional()->text(200),
            'location' => $this->faker->optional()->city(),
            'website' => $this->faker->optional()->url(),
            'twitter_username' => $this->faker->optional()->userName(),
            'github_username' => $this->faker->optional()->userName(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user should have a personal team.
     */
    public function withPersonalTeam(?callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }

    // Optional: Add a method to create a user with specific social details
    public function withSocialDetails(array $socialDetails = []): static
    {
        return $this->state(function (array $attributes) use ($socialDetails) {
            return array_merge([
                'username' => $socialDetails['username'] ?? fake()->unique()->userName(),
                'bio' => $socialDetails['bio'] ?? fake()->optional()->paragraph(),
                'location' => $socialDetails['location'] ?? fake()->optional()->city(),
                'website' => $socialDetails['website'] ?? fake()->optional()->url(),
                'birth_date' => $socialDetails['birth_date'] ?? fake()->optional()->dateTimeBetween('-50 years', '-18 years'),
            ], $attributes);
        });
    }
}
