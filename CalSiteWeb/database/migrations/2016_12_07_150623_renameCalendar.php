<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCalendar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Rename calendar table to avoid conflicts with fullcalendar framework
        Schema::rename("calendars", "agendas");
        Schema::rename("calendar_user", "agenda_user");
        Schema::table('tasks', function ($table) {
            $table->renameColumn('calendar_id', 'agenda_id');
        });
        Schema::table('agenda_user', function ($table) {
            $table->renameColumn('calendar_id', 'agenda_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename("agendas", "calendars");
        Schema::rename("agenda_user", "calendar_user");
        Schema::table('tasks', function ($table) {
            $table->renameColumn('agenda_id', 'calendar_id');
        });
        Schema::table('calendar_user', function ($table) {
            $table->renameColumn('agenda_id', 'calendar_id');
        });
    }
}
