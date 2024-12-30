<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('provider_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->boolean('load_balance')->default(false);
            $table->integer('provider_count')->default(0);
            $table->json('provider_details')->nullable(); // Store multiple providers
            $table->boolean('dedicated_service')->default(false);
            $table->boolean('broadband_service')->default(false);
            $table->boolean('voucher_service')->default(false);
            $table->json('partners')->nullable(); // Store partner details
            $table->date('installation_date')->nullable();
            $table->string('google_map_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_locations');
    }
};
