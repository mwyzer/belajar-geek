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
        Schema::create('voucher_import_scripts', function (Blueprint $table) {
            $table->id();
            $table->text('script');
            $table->string('profile_name', 255);
            $table->text('comment')->nullable();
            $table->unsignedBigInteger('limit_bytes_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_import_scripts');
    }
};
