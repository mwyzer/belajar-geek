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
            $table->string('name'); // Provider name
            $table->string('type'); // Pascabayar, Prabayar, Metro, Satelit
            $table->string('provider'); // Provider company name
            $table->string('number'); // Contact or identification number
            $table->string('position'); // ISP-01, ISP-02, etc.
            $table->string('owner'); // Owner of the provider
            $table->string('status'); // Terpasang, Stand By, Bermasalah
            $table->boolean('load_balance')->default(false); // Load Balance status
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
