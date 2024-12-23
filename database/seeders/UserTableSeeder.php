<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or find user
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Search by email
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );

        // Get all permissions
        $permissions = Permission::all();

        // Get or create the role 'admin'
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Assign permissions to role
        $role->syncPermissions($permissions);

        // Assign role to user
        if (!$user->hasRole('admin')) {
            $user->assignRole($role);
        }
    }
}
