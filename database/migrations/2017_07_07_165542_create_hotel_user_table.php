<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_user', function (Blueprint $table) {
            $table->integer('hotel_id',false,true)->length(10);
            $table->integer('user_id',false,true)->length(10);

            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_user', function (Blueprint $table) {
            $table->dropForeign('hotel_id');
            $table->dropForeign('user_id');
        });
        Schema::dropIfExists('hotel_user');
    }
}
