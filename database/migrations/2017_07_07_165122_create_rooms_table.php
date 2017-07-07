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
            $table->integer('hotel_id',false,true)->length(10);
            $table->integer('category_id',false,true)->length(10);
            $table->string('title',50);
            $table->text('description',50);
            $table->integer('number_of_rooms');
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('hotel_id');
            $table->dropForeign('category_id');
        });
        Schema::dropIfExists('rooms');
    }
}
