<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->string('description', 200);
            $table->integer('priority');
            $table->string('location', 100);
            $table->string('attachment_url', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task');
    }
}
