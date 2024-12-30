<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    public function run()
    {
        Provider::create([
            'name' => '0815-2822-1221',
            'type' => 'Pascabayar',
            'provider' => 'Kartu Halo',
            'number' => 'ISP-01',
            'position' => 'ISP-01',
            'owner' => 'User 1',
            'status' => 'Terpasang',
            'load_balance' => true,
            'location_id' => 1,
        ]);

        Provider::create([
            'name' => '0812-5654-8931',
            'type' => 'Prabayar',
            'provider' => 'Kartu Byu',
            'number' => 'ISP-02',
            'position' => 'ISP-02',
            'owner' => 'User 2',
            'status' => 'Stand By',
            'load_balance' => false,
            'location_id' => 2,
        ]);
    }
}
