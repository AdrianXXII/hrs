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
            $table->integer('roomtype_id',false,true)->length(10);

            $table->foreign('roomtype_id')->references('id')->on('roomtypes');
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
        Schema::table('attribute_room', function (Blueprint $table) {
            $table->dropForeign('attribute_room_roomtype_id_foreign');
            $table->dropForeign('attribute_room_attribute_id_foreign');
        });
        Schema::dropIfExists('attribute_room');
    }
}
