<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'create tweets',
            'delete tweets',
            'edit tweets',
            'create comments',
            'delete comments',
            'manage users',
            'manage roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo([
            'delete tweets',
            'delete comments',
            'manage users',
        ]);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'create tweets',
            'create comments',
        ]);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');
    }
} 