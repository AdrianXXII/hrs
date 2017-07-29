<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roomtype_id',false,true)->length(10);
            $table->timestamp('bookdate')->nullable();
            $table->timestamp('reservation_start')->nullable();
            $table->timestamp('reservation_end')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('number_of_people')->length(2)->nullable();
            $table->string('name',30)->nullable();
            $table->string('firstname',30)->nullable();
            $table->string('email',50)->nullable();
            $table->string('telephone',20)->nullable();
            $table->integer('status')->length(1)->nullable();
            $table->boolean('active')->nullable();

            $table->foreign('roomtype_id')->references('id')->on('roomtypes');
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
            $table->dropForeign('reservations_roomtype_id_foreign');
        });
        Schema::dropIfExists('reservations');
    }
}
