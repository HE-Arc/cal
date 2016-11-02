<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('add_task');
            $table->boolean('edit_task');
            $table->boolean('delete_task');
            $table->boolean('add_member');
            $table->boolean('remove_member');
            $table->boolean('edit_calendar');
            $table->boolean('delete_calendar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission');
    }
}
