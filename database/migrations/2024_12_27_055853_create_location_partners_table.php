<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationPartnersTable extends Migration
{
    public function up(): void
    {
        Schema::create('location_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locationId');
            $table->unsignedBigInteger('partnerTypeId');
            $table->string('status', 255);
            $table->integer('maxCount');
            $table->integer('filledCount')->nullable();
            $table->timestamp('createdAt')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('location_partners');
    }
}