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
        // Fetch data from the API with headers
        $response = Http::withHeaders([
            'key' => config('rajaongkir.api_key'),
        ])->get('https://api.rajaongkir.com/starter/province');

        // Check if the response is successful and the data structure is as expected
        if ($response->successful() && isset($response['rajaongkir']) && isset($response['rajaongkir']['results'])) {
            // Loop through each province in the response data
            foreach ($response['rajaongkir']['results'] as $province) {
                // Insert each province into the "provinces" table
                Province::create([
                    'id'    => $province['province_id'],
                    'name'  => $province['province']
                ]);
            }
        } else {
            // Log an error message if the response was not as expected
            $statusCode = $response->status();
            $errorMessage = $response->json('rajaongkir.status.description') ?? 'Unexpected API response structure.';
            Log::error("Provinces seeder failed with status code $statusCode: $errorMessage");
        }
    }
}
