<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use DateTime;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Nope
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($calendarId)
    {
        return view('createTask', ['calendarId' => $calendarId,'mode' => 0]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($calendarId, Request $request)
    {
        //validation
        $rules = array(
            'title'             => 'required|max:255|min:3',
            'time_start'        => 'required',
            'date_start'        => 'required',
            'time_end'          => 'required',
            'date_end'          => 'required',
            'description'       => 'max:255',
            'priority'          => 'required',
            'location'          => 'max:255',
            'attachment_url'    => 'max:255',
        );
        $this->validate($request, $rules);

        $task = new Task;
        $task->title = $request->title;
        $task->time_start = new DateTime($request->date_start."T".$request->time_start);
        $task->time_end = new DateTime($request->date_end."T".$request->time_end);
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->location = $request->location;
        $task->attachment_url = $request->attachment_url;
        $task->agenda_id = $calendarId;
        $task->save();

        return redirect()->route('calendar.show', ['calendarId' => $calendarId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($calendarId, $id)
    {
        // Nope
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($calendarId, $id)
    {
        $task = Task::where('id', $id)->first();

        $valueTimeStart = explode(" ", $task->time_start);
        $valueTimeEnd = explode(" ", $task->time_end);

        $t =date_create_from_format('Y-m-d', $valueTimeStart[0]);

        return view('createTask', ['calendarId' => $calendarId,'mode' => 1, 'task' => $task, 'timeStart' => $valueTimeStart,'timeEnd' => $valueTimeEnd, 't'=>$t]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $calendarId, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($calendarId, $id)
    {
        //
    }
}
