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
        Schema::create('prepaid_providers', function (Blueprint $table) {
            $table->id();
            $table->string('number', 255);
            $table->string('provider', 255);
            $table->unsignedBigInteger('locationId');
            $table->string('position', 255)->nullable();
            $table->json('holders')->nullable(); // Store multiple holders dynamically
            $table->enum('status', ['Terpasang', 'Stand By', 'Bermasalah'])->default('Stand By');
            $table->string('email_login')->nullable();
            $table->date('open_accounting_date')->nullable();
            $table->integer('limit', 10);
            $table->boolean('system_refill')->default(false);
            $table->boolean('manual_package')->default(false);
            $table->json('packages')->nullable(); // Store packages dynamically
            $table->decimal('other_charges', 10, 2)->default(0.00);
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
        //
        Schema::dropIfExists('prepaid_providers');
    }
};
