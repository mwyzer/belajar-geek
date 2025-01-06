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
        Schema::create('voucher_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('profile_name');
            $table->integer('quota');
            $table->string('quota_unit');
            $table->integer('active_period');
            $table->string('active_unit');
            $table->integer('stock_warning');
            $table->integer('stock_alert');
            $table->boolean('is_published')->default(false);
            $table->boolean('show_stock')->default(true);
            $table->integer('max_purchase_per_transaction')->default(5);
            $table->string('generate_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_profiles');
    }
};
