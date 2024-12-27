<?php

// database/migrations/xxxx_xx_xx_create_customer_status_histories_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerStatusHistoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('customer_status_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId');
            $table->string('status', 255);
            $table->timestamp('changedAt');
            $table->timestamps();

            $table->foreign('customerId')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_status_histories');
    }
}
