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
        // Fetch data from the API with headers
        $response = Http::withHeaders([
            'key' => config('rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/city');

        // Check if the response is successful and the data structure is as expected
        if ($response->successful() && isset($response['rajaongkir']) && isset($response['rajaongkir']['results'])) {
            // Loop through each city in the response data
            foreach ($response['rajaongkir']['results'] as $city) {
                // Insert each city into the "cities" table
                City::create([
                    'id'          => $city['city_id'],
                    'province_id' => $city['province_id'],
                    'name'        => $city['city_name'],
                    'type'        => $city['type'],
                    'postal_code' => $city['postal_code']
                ]);
            }
        } else {
            // Log an error message if the response was not as expected
            $statusCode = $response->status();
            $errorMessage = $response->json('rajaongkir.status.description') ?? 'Unexpected API response structure.';
            Log::error("Cities seeder failed with status code $statusCode: $errorMessage");
        }
    }
}
