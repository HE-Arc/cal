<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameToStandardsNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //task table
        Schema::rename("task", "tasks");

        //calendar table
        Schema::rename("calendar", "calendars");

        //permission table
        Schema::rename("permission", "permissions");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //task table
        Schema::rename("tasks", "task");

        //calendar table
        Schema::rename("calendars", "calendar");

        //permission table
        Schema::rename("permissions", "permission");
    }
}
