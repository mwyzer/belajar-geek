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
        Schema::create('daily_billings', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('serviceId'); // INT NOT NULL
            $table->timestamp('billingDate'); // TIMESTAMP NOT NULL
            $table->integer('amount'); // NUMERIC NOT NULL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_billings');
    }
};
