<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Agenda;
use App\Task;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('createCalendar', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // create the validation rules ------------------------
        $rules = array(
            'title' => 'required|max:255|min:5',
            'priority_high_color'   => 'required',
            'priority_medium_color'   => 'required',
            'priority_low_color'   => 'required',
        );

        $this->validate($request, $rules);

        //Create the agenda
        $agenda = new Agenda;
        $agenda->title = $request->title;
        $agenda->priority_high_color = substr($request->priority_high_color, 1);    //substr to remove the # (#FFFFFF)
        $agenda->priority_medium_color = substr($request->priority_medium_color, 1);
        $agenda->priority_low_color = substr($request->priority_low_color, 1);

        $agenda->save();

        //Link user to agenda
        $agenda->users()->attach($user->id, [
            'add_task'          => true,
            'edit_task'         => true,
            'delete_task'       => true,
            'add_member'        => true,
            'remove_member'     => true,
            'edit_calendar'     => true,
            'delete_calendar'   => true,
        ]);

        $agenda->save();

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($calendarId)
    {
        $agenda = Agenda::where('id', $calendarId)->first();
        $tasks = $agenda->tasks()->get();

        $calendar = \Calendar::addEvents([]);

        foreach ($tasks as $task) {
            switch ($task->priority) {
                case '1':
                    $color = "#".$agenda->priority_low_color;
                    break;
                case '2':
                    $color = "#".$agenda->priority_medium_color;
                    break;
                case '3':
                    $color = "#".$agenda->priority_high_color;
                    break;

                default:
                    $color = "#000000";
                    break;
            }


            $event = \Calendar::event(
                $task->title,           //title
                false,                  //is full day event ?
                $task->time_start,      //start time
                $task->time_end,        //end time
                $task->id,              //optionnal event id
                [
                    //any other full-calendar supported parameters
                    'url' => '/calendar/'.$calendarId.'/tasks/'.$task->id.'/edit',
                    'color' => $color
                ]
            );

            $calendar = \Calendar::addEvent($event);
        }
        $calendar->setOptions([
            'timeFormat'  => 'H:mm' // uppercase H for 24-hour clock
        ]);
        return view('calendar', ['calendar' => $calendar, 'calendarId' => $calendarId]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
