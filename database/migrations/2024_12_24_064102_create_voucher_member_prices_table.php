<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('voucher_member_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_profile_id');
            $table->unsignedBigInteger('member_level_id');
            $table->integer('price_points');
            $table->timestamps();

            $table->foreign('voucher_profile_id')
                ->references('id')
                ->on('voucher_profiles')
                ->onDelete('cascade');

            $table->foreign('member_level_id')
                ->references('id')
                ->on('member_levels')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('voucher_member_prices', function (Blueprint $table) {
            $table->dropForeign(['voucher_profile_id']);
            $table->dropForeign(['member_level_id']);
        });
    
        Schema::dropIfExists('voucher_member_prices');
    }
};
