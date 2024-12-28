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
        Schema::create('location_isps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locationId');
            $table->unsignedBigInteger('ispId');
            $table->string('ispType', 255);
            $table->string('contactNumber', 255);
            $table->timestamps(); // Automatically includes created_at a
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_isps');
    }
};
