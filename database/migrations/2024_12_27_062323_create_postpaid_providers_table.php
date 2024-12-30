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
        //
        Schema::create('postpaid_providers', function (Blueprint $table) {
            $table->id();
            $table->string('number', 255);
            $table->string('provider', 255);
            $table->unsignedBigInteger('locationId');
            $table->string('position', 255)->nullable();
            $table->string('holder', 255)->nullable();
            $table->enum('status', ['Terpasang', 'Stand By', 'Bermasalah'])->default('Stand By');
            $table->decimal('limit', 10, 2)->default(0.00);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('locationId')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postpaid_providers');
    }
};
