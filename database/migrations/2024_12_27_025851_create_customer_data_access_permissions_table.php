<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_data_access_permissions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('customer_data_category_id')
                  ->constrained('customer_data_categories')
                  ->onDelete('cascade'); // Foreign key to CustomerDataCategory
            $table->integer('partner_type_id')->unsigned();
            $table->integer('access_level_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_data_access_permissions');
    }
};
