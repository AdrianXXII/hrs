<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertGroupsTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('groups')->insert(array('name'=>'Adminstrator'));
        DB::table('groups')->insert(array('name'=>'Hotelangestler'));
        DB::table('groups')->insert(array('name'=>'Hotelmanager'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Nothing for now
    }
}
