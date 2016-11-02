<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('calendar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('priority_low_color', 6);
            $table->string('priority_medium_color', 6);
            $table->string('priority_high_color', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calendar');
    }
}
