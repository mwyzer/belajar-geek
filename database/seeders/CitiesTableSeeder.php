<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CitiesTableSeeder extends Seeder
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
            ])->get('https://api.rajaongkir.com/starter/city');

            // Check if the response is successful and the data structure is as expected
            if ($response->successful() && isset($response['rajaongkir']['results'])) {
                foreach ($response['rajaongkir']['results'] as $city) {
                    // Use updateOrCreate to prevent duplicate ID issues
                    City::updateOrCreate(
                        ['id' => $city['city_id']], // Match by city_id
                        [
                            'province_id' => $city['province_id'],
                            'name'        => $city['city_name'],
                            'type'        => $city['type'],
                            'postal_code' => $city['postal_code'],
                        ]
                    );
                }

                $this->command->info('Cities seeded successfully.');
            } else {
                $statusCode = $response->status();
                $errorMessage = $response->json('rajaongkir.status.description') ?? 'Unexpected API response structure.';
                Log::error("Cities seeder failed with status code $statusCode: $errorMessage");
                $this->command->error("Seeder failed: $errorMessage");
            }
        } catch (\Exception $e) {
            Log::error('Cities seeder error: ' . $e->getMessage());
            $this->command->error('Cities seeder error: ' . $e->getMessage());
        }
    }
}
