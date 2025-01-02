<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin role and user
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        // Assign all permissions to admin role
        $permissions = Permission::all();
        $adminRole->syncPermissions($permissions);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
            ]
        );

        // Create customer user
        $customer = User::firstOrCreate(
            ['email' => 'rish@gmail.com'],
            [
                'name' => 'Customer User',
                'password' => bcrypt('password'),
            ]
        );

        // Assign roles
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        if (!$customer->hasRole('customer')) {
            $customer->assignRole($customerRole);
        }
    }
}
