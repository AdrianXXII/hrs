<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_room', function (Blueprint $table) {
            $table->integer('attribute_id',false,true)->length(10);
            $table->integer('room_id',false,true)->length(10);

            $table->foreign('room_id')->references('id')->on('rooms');
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
            $table->dropForeign('room_id');
            $table->dropForeign('attribute_id');
        });
        Schema::dropIfExists('attribute_room');
    }
}
