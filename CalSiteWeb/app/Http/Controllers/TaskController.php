<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Agenda;
use App\User;
use Auth;
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
        return view('createTask', ['calendarId' => $calendarId,'mode' => 'create']);
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

        $agenda = Agenda::where('id', $calendarId)->first();

        $users = $agenda->users()->get();
        //correlate currentUser with users from agenda to get necessary information to determine rights of user on calendar
        $currentUser = Auth::user();
        foreach ($users as $user)
            if ($user->id == $currentUser->id)
                $currentUser = $user;

        $canDelete = $currentUser->pivot->delete_task;

        $dateTimeStart = date_create($task->time_start);
        $dateTimeEnd = date_create($task->time_end);



        return view('createTask', ['calendarId' => $calendarId,'mode' => 'edit', 'task' => $task, 'dateTimeStart' => $dateTimeStart,'dateTimeEnd' => $dateTimeEnd, 'canDelete' => $canDelete]);
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
        // sql
        $task = Task::find($id);
        // create the validation rules ------------------------
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

        $task->title = $request->title;
        $task->time_start = new DateTime($request->date_start."T".$request->time_start);
        $task->time_end = new DateTime($request->date_end."T".$request->time_end);
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->location = $request->location;
        $task->attachment_url = $request->attachment_url;
        $task->agenda_id = $calendarId;
        $task->save();


        // redirect
        return redirect()->route('calendar.show', ['calendarId' => $calendarId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($calendarId, $id)
    {
        // redirect
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('calendar.show', ['calendarId' => $calendarId]);
    }
}
