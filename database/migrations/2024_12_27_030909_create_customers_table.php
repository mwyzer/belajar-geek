<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customerTitle', 255);
            $table->string('customerName', 255);
            $table->string('customerWhatsappNumber', 255)->nullable();
            $table->string('customerLocation', 255);
            $table->string('customerOccupation', 255)->nullable();
            $table->string('customerPosition', 255)->nullable();
            $table->binary('customerPhotoself')->nullable();
            $table->binary('customerSelfPhotoWithId')->nullable();
            $table->binary('customerPhotoId')->nullable();
            $table->unsignedInteger('membershipLevelId');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}