<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherPartnerPricesTable extends Migration
{
    public function up(): void
    {
        Schema::create('voucher_partner_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucherProfileId');
            $table->unsignedBigInteger('partnerTypeId');
            $table->integer('pricePoints');
            $table->timestamps();

            $table->foreign('partnerTypeId')->references('id')->on('partner_types')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voucher_partner_prices');
    }
}