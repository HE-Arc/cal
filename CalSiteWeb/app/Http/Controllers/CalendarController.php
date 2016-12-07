<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Task;
use App\Agenda;

class CalendarController extends Controller {

    public function index()
    {
        //TODO get agenda id from somewere
        $agenda_id = 7;
        $agenda = Agenda::where('id', $agenda_id)->first();
        $tasks = $agenda->tasks()->get();

        foreach ($tasks as $task) {
            $event = \Calendar::event(
                $task->title,           //title
                false,                  //is full day event ?
                $task->time_start,      //start time
                $task->time_end,        //end time
                $task->id,              //optionnal event id
                [
                    //any other full-calendar supported parameters

                ]
            );

            $calendar = \Calendar::addEvent($event);
        }
        $calendar->setOptions([
            'timeFormat'  => 'h:mm' // uppercase H for 24-hour clock
        ]);
        return view('calendar', compact('calendar'));
    }

}
