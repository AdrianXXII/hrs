<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hotel_id',false,true)->length(10);
            $table->integer('category_id',false,true)->length(10);
            $table->string('title',50);
            $table->text('description',50);
            $table->decimal('price');
            $table->boolean('active');

            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roomtypes', function (Blueprint $table) {
            $table->dropForeign('roomtypes_hotel_id_foreign');
            $table->dropForeign('roomtypes_category_id_foreign');
        });
        Schema::dropIfExists('roomtypes');
    }
}
