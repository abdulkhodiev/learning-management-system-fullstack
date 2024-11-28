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
        // Create Permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view task']);
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'update task']);
        Permission::create(['name' => 'delete task']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $mentorRole = Role::create(['name' => 'mentor']);
        $studentRole = Role::create(['name' => 'student']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create task', 'view task', 'update task']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
                    'email' => 'superadmin@gmail.com',
                ], [
                    'first_name' => 'Super',
                    'last_name' => 'Admin',
                    'username' => 'superadmin',
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make ('87654321'),
                ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
                            'email' => 'student@gmail.com'
                        ], [
                            'first_name' => 'Student',
                            'last_name' => 'User',
                            'username' => 'student',
                            'email' => 'student@gmail.com',
                            'password' => Hash::make ('87654321'),
                        ]);

        $adminUser->assignRole($adminRole);


        $mentorUser = User::firstOrCreate([
                            'email' => 'mentor@gmail.com',
                        ], [
                            'first_name' => 'Mentor',
                            'last_name' => 'User',
                            'username' => 'mentor',
                            'email' => '@gmail.com',
                            'password' => Hash::make('87654321'),
                        ]);

        $mentorUser->assignRole($mentorRole);
    }
}
