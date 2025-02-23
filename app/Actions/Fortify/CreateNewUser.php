<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Generate a cool Reddit-style username
     */
    private function generateCoolUsername(): string
    {
        $adjectives = [
            'Cyber', 'Neon', 'Quantum', 'Cosmic', 'Digital', 'Pixel', 
            'Techno', 'Glitch', 'Crypto', 'Neural', 'Synth', 'Retro', 
            'Phantom', 'Shadow', 'Rebel', 'Rogue', 'Apex', 'Prime', 
            'Hyper', 'Stellar', 'Savage', 'Epic', 'Legendary'
        ];

        $nouns = [
            'Hacker', 'Rider', 'Warrior', 'Knight', 'Ninja', 'Wizard', 
            'Pilot', 'Runner', 'Striker', 'Phantom', 'Blade', 'Spark', 
            'Ghost', 'Rebel', 'Titan', 'Sentinel', 'Raven', 'Wolf', 
            'Dragon', 'Phoenix', 'Vortex', 'Cipher', 'Nexus'
        ];

        $numbers = range(0, 999);

        $adjective = $adjectives[array_rand($adjectives)];
        $noun = $nouns[array_rand($nouns)];
        $number = str_pad(strval($numbers[array_rand($numbers)]), 3, '0', STR_PAD_LEFT);

        return Str::slug($adjective . $noun . $number);
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Generate a unique username
        $username = $this->generateCoolUsername();
        
        // Ensure username is unique
        while (User::where('username', $username)->exists()) {
            $username = $this->generateCoolUsername();
        }

        // Create the user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'username' => $username,
            'password' => Hash::make($input['password']),
        ]);

        // Assign default user role
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($userRole);

        // Define and assign default permissions for new users
        $defaultPermissions = [
            // Tweet Permissions
            'tweet_view',
            'tweet_create',
            'tweet_like',
            'tweet_retweet',

            // Hashtag Permissions
            'hashtag_view',

            // Achievement Permissions
            'achievement_view',

            // User Profile Permissions
            'user_view',
            'user_profile_edit',

            // Theme Permissions
            'theme_view',
            'theme_update'
        ];

        // Ensure permissions exist before assigning
        foreach ($defaultPermissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to the user
        $user->givePermissionTo($defaultPermissions);

        return $user;
    }
}
