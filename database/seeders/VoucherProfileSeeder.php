<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VoucherProfile;

class VoucherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Base data for profiles
        $baseData = [
            'profile_name' => 'VoucherProfile',
            'quota' => 15,
            'quota_unit' => 'GB',
            'stock_warning' => 10,
            'stock_alert' => 5,
            'is_published' => true,
            'show_stock' => true,
            'max_purchase_per_transaction' => 5,
            'generate_link' => null,
        ];

        // Loop to create 60 profiles
        for ($i = 1; $i <= 60; $i++) {
            VoucherProfile::create([
                'profile_name' => $baseData['profile_name'] . $i, // Example: VoucherProfile1, VoucherProfile2, etc.
                'quota' => $baseData['quota'],
                'quota_unit' => $baseData['quota_unit'],
                'stock_warning' => $baseData['stock_warning'],
                'stock_alert' => $baseData['stock_alert'],
                'is_published' => $baseData['is_published'],
                'show_stock' => $baseData['show_stock'],
                'max_purchase_per_transaction' => $baseData['max_purchase_per_transaction'],
                'generate_link' => $baseData['generate_link'],
            ]);
        }
    }
}
