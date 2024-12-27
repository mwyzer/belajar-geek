<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('voucher_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_profile_id')->constrained('voucher_profiles')->onDelete('cascade');
            $table->boolean('issue_voucher')->default(false);
            $table->boolean('display_stock')->default(false);
            $table->integer('max_purchase_per_tx')->nullable();
            $table->string('link_to_generate_voucher')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_settings');
    }
};
