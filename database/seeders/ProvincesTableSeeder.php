<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Fetch data from the API with headers
            $response = Http::withHeaders([
                'key' => config('rajaongkir.api_key'),
            ])->get('https://api.rajaongkir.com/starter/province');

            // Check if the response is successful and the data structure is as expected
            if ($response->successful() && isset($response['rajaongkir']['results'])) {
                foreach ($response['rajaongkir']['results'] as $province) {
                    // Use updateOrCreate to prevent duplicate ID issues
                    Province::updateOrCreate(
                        ['id' => $province['province_id']], // Check by ID
                        ['name' => $province['province']]   // Update or set the name
                    );
                }

                $this->command->info('Provinces seeded successfully.');
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->json('rajaongkir.status.description') ?? 'Unexpected API response structure.';
                Log::error("Provinces seeder failed with status code $statusCode: $errorMessage");
                $this->command->error("Seeder failed: $errorMessage");
            }
        } catch (\Exception $e) {
            Log::error('Provinces seeder error: ' . $e->getMessage());
            $this->command->error('Provinces seeder error: ' . $e->getMessage());
        }
    }
}
