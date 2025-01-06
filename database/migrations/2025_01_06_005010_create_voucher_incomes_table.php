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
        Schema::create('voucher_incomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_type_id')
                  ->constrained('voucher_types')
                  ->onDelete('cascade');
            $table->decimal('income', 10, 2);
            $table->integer('points')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_incomes');
    }
};
