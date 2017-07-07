<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeHotelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_hotel', function (Blueprint $table) {
            $table->integer('attribute_id',false,true)->length(10);
            $table->integer('hotel_id',false,true)->length(10);

            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('attribute_id')->references('id')->on('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('hotel_id');
            $table->dropForeign('attribute_id');
        });
        Schema::dropIfExists('attribute_hotel');
    }
}
