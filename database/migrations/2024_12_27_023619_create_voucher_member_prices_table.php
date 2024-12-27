<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_member_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_profile_id')
                ->constrained('voucher_profiles')
                ->onDelete('cascade');
            $table->foreignId('member_level_id')
                ->constrained('member_levels')
                ->onDelete('cascade');
            $table->integer('price_points')->notNullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_member_prices');
    }
};
