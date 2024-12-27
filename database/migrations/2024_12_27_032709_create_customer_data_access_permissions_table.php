<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDataAccessPermissionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('customer_data_access_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partnerTypeId');
            $table->unsignedBigInteger('customerDataCategoryId');
            $table->integer('accessLevelId');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('partnerTypeId')->references('id')->on('partner_types')->onDelete('cascade');
            $table->foreign('customerDataCategoryId')->references('id')->on('customer_data_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_data_access_permissions');
    }
}