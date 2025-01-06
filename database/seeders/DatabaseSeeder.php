<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            UserTableSeeder::class,
            ProvincesTableSeeder::class,
            CitiesTableSeeder::class,
            LocationTableSeeder::class,
            ProviderTableSeeder::class,
            VoucherProfileSeeder::class,
        ]);
    }
}
