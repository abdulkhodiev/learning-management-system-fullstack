<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions one by one
        $permissions = [
            'view role',
            'create role',
            'update role',
            'delete role',
            'view permission',
            'create permission',
            'update permission',
            'delete permission',
            'view user',
            'create user',
            'update user',
            'delete user',
            'view task',
            'create task',
            'update task',
            'delete task',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $studentRole = Role::create(['name' => 'student']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();
        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo([
            'create role', 'view role', 'update role',
            'create permission', 'view permission',
            'create user', 'view user', 'update user',
            'create task', 'view task', 'update task'
        ]);

        // Create Users and assign Roles
        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('87654321'),
        ]);

        $superAdminUser->assignRole($superAdminRole);

        $adminUser = User::firstOrCreate([
            'email' => 'student@gmail.com',
        ], [
            'first_name' => 'Student',
            'last_name' => 'User',
            'username' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('87654321'),
        ]);

        $adminUser->assignRole($adminRole);

        $mentorUser = User::firstOrCreate([
            'email' => 'mentor@gmail.com',
        ], [
            'first_name' => 'Mentor',
            'last_name' => 'User',
            'username' => 'mentor',
            'email' => 'mentor@gmail.com',
            'password' => Hash::make('87654321'),
        ]);

        $mentorUser->assignRole($mentorRole);
    }
}

