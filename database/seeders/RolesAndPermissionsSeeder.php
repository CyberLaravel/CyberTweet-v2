<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions for Users
        $userPermissions = [
            'user_view',
            'user_create',
            'user_update',
            'user_delete',
            'user_profile_edit',
        ];

        // Permissions for Tweets
        $tweetPermissions = [
            'tweet_view',
            'tweet_create',
            'tweet_update',
            'tweet_delete',
            'tweet_like',
            'tweet_retweet',
        ];

        // Permissions for Achievements
        $achievementPermissions = [
            'achievement_view',
            'achievement_create',
            'achievement_update',
            'achievement_delete',
        ];

        // Permissions for Hashtags
        $hashtagPermissions = [
            'hashtag_view',
            'hashtag_create',
            'hashtag_update',
            'hashtag_delete',
        ];

        // Permissions for User Themes
        $themePermissions = [
            'theme_view',
            'theme_update',
        ];

        // Combine all permissions
        $allPermissions = array_merge(
            $userPermissions, 
            $tweetPermissions, 
            $achievementPermissions, 
            $hashtagPermissions,
            $themePermissions
        );

        // Create Permissions
        foreach ($allPermissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create Roles
        $adminRole = Role::findOrCreate('admin');
        $moderatorRole = Role::findOrCreate('moderator');
        $userRole = Role::findOrCreate('user');

        // Admin Role - Full Access
        $adminRole->syncPermissions($allPermissions);

        // Moderator Role - Limited Access
        $moderatorPermissions = array_merge(
            $userPermissions,
            $tweetPermissions,
            $achievementPermissions,
            $hashtagPermissions,
            ['theme_view']
        );
        $moderatorRole->syncPermissions($moderatorPermissions);

        // User Role - Basic Access
        $userBasicPermissions = [
            'tweet_view',
            'tweet_create',
            'tweet_like',
            'tweet_retweet',
            'achievement_view',
            'hashtag_view',
            'user_profile_edit',
            'theme_view',
            'theme_update'
        ];
        $userRole->syncPermissions($userBasicPermissions);
    }
} 