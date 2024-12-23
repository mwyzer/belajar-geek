<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::insert([
            [
                'name' => 'Downtown Office',
                'address' => '123 Main St, Downtown City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'West Side Branch',
                'address' => '456 West St, West City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'East Side Hub',
                'address' => '789 East Ave, East City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'North Point Center',
                'address' => '321 North Blvd, North City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'South Gateway Plaza',
                'address' => '654 South Rd, South City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
