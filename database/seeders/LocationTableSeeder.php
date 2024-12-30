<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    public function run(): void
    {
        Location::insert([
            [
                'name' => 'Downtown Office',
                'address' => '123 Main St, Downtown City',
                'image' => 'downtown-office.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'West Side Branch',
                'address' => '456 West St, West City', 
                'image' => 'west-branch.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'East Side Hub',
                'address' => '789 East Ave, East City',
                'image' => 'east-hub.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
