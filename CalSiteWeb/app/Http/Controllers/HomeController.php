<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\Agenda;
use App\User;
use Calendar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $agendas = $user->agendas()->with('tasks')->get();

        $listAgendas = [];

        $calendar = Calendar::addEvents([]);

        foreach ($agendas as $agenda) {
            $listAgendas[$agenda->id] = $agenda->title;

            foreach ($agenda->tasks()->get() as $task) {
                $event = Calendar::event(
                    $task->title,           //title
                    false,                  //is full day event ?
                    $task->time_start,      //start time
                    $task->time_end,        //end time
                    $task->id,              //optionnal event id
                    [
                        //any other full-calendar supported parameters
                        'url' => Route('tasks.edit', ['calendarId' => $agenda->id, 'taskId' => $task->id]),
                        'color' => $task->color,
                    ]
                );

                $calendar = Calendar::addEvent($event);
            }
        }

        $calendar->setOptions([
            'header' => [
				'left' => '',
				'center' => '',
				'right' => ''
			],
            'defaultView'   =>  'listMonth',  //List layout
            'timeFormat'    =>  'h:mm' // uppercase H for 24-hour clock
        ]);


        return view('home', ['calendar' => $calendar, 'listAgendas' => $listAgendas, 'user' => $user, 'agendas'=>$agendas]);
    }
}
