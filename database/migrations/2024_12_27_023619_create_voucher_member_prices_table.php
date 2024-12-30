<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('voucher_member_prices')) {
            Schema::create('voucher_member_prices', function (Blueprint $table) {
                $table->id();
                $table->foreignId('member_level_id')
                      ->constrained('member_levels')
                      ->onDelete('cascade');
                $table->foreignId('voucher_profile_id')
                      ->constrained('voucher_profiles')
                      ->onDelete('cascade');
                $table->integer('price_points')->notNullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::table('voucher_member_prices', function (Blueprint $table) {
            $table->dropForeign(['voucher_profile_id']);
            $table->dropForeign(['member_level_id']);
        });
        
        Schema::dropIfExists('voucher_member_prices');
    }
};
