<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->string('location_name');
            $table->string('provider_type');
            $table->json('numbers');
            $table->string('provider_status');
            $table->boolean('is_suk')->default(false);
            $table->string('k1h')->nullable();
            $table->string('pln_number')->nullable();
            $table->string('pln_name')->nullable();
            $table->string('wifi_private_pass');
            $table->string('wifi_main_pass');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
