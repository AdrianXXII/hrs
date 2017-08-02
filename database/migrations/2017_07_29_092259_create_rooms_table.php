<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_number')->length(30);
            $table->integer('roomtype_id',false,true);
            $table->boolean('active');

            $table->foreign('roomtype_id')->references('id')->on('roomtypes');

        });
        Schema::table('reservations', function (Blueprint $t) {
            $t->integer('room_id',false,true);
            $t->foreign('room_id')->references('id')->on('rooms');
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
            $table->dropForeign('reservations_room_id_foreign');
        });
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropForeign('rooms_roomtype_id_foreign');
        });

        Schema::dropIfExists('rooms');
    }
}
