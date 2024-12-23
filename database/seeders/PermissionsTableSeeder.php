<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission Dashboard
        Permission::firstOrCreate(['name' => 'dashboard.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'dashboard.statistics', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'dashboard.chart', 'guard_name' => 'web']);

        // Permission Users
        Permission::firstOrCreate(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'users.delete', 'guard_name' => 'web']);

        // Permission Roles
        Permission::firstOrCreate(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'roles.delete', 'guard_name' => 'web']);

        // Permission Permissions
        Permission::firstOrCreate(['name' => 'permissions.index', 'guard_name' => 'web']);

        // Permission Colors
        Permission::firstOrCreate(['name' => 'colors.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'colors.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'colors.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'colors.delete', 'guard_name' => 'web']);

        // Permission Warnas
        Permission::firstOrCreate(['name' => 'warnas.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'warnas.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'warnas.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'warnas.delete', 'guard_name' => 'web']);

        // Permission Warnas
        Permission::firstOrCreate(['name' => 'locations.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'locations.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'locations.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'locations.delete', 'guard_name' => 'web']);

        // Permission Categories
        Permission::firstOrCreate(['name' => 'categories.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'categories.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'categories.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'categories.delete', 'guard_name' => 'web']);

        // Permission Products
        Permission::firstOrCreate(['name' => 'products.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'products.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'products.show', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'products.edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'products.delete', 'guard_name' => 'web']);

        // Permission Transactions
        Permission::firstOrCreate(['name' => 'transactions.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'transactions.show', 'guard_name' => 'web']);

        // Permission Sliders
        Permission::firstOrCreate(['name' => 'sliders.index', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'sliders.create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'sliders.delete', 'guard_name' => 'web']);
    }
}
