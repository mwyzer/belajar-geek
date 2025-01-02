<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Downtown Office',
                'address' => '123 Main St, Downtown City',
                'image' => 'downtown-office.jpg',
            ],
            [
                'name' => 'West Side Branch',
                'address' => '456 West St, West City',
                'image' => 'west-branch.jpg',
            ],
            [
                'name' => 'East Side Hub',
                'address' => '789 East Ave, East City',
                'image' => 'east-hub.jpg',
            ]
        ];

        foreach ($locations as $location) {
            Location::updateOrCreate(
                ['name' => $location['name']], // Match by 'name' to prevent duplicates
                [
                    'address' => $location['address'],
                    'image' => $location['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Locations seeded successfully.');
    }
}
