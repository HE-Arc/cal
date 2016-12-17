<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permission', function ($table) {
            $table->integer('user_id')->unsigned();
            $table->integer('calendar_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('calendar_id')->references('id')->on('calendar')->onDelete('cascade');
        });
        Schema::table('task', function ($table) {
            $table->integer('calendar_id')->unsigned();
            $table->foreign('calendar_id')->references('id')->on('calendar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
