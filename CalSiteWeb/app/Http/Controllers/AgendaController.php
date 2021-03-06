<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Agenda;
use App\Task;
use Calendar;
use DB;

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
        return view('handleCalendar', ['user' => $user, 'mode' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // create the validation rules ------------------------
        $rules = array(
            'title' => 'required|max:255|min:5',
            'priority_high_color' => 'required',
            'priority_medium_color' => 'required',
            'priority_low_color' => 'required',
        );

        $this->validate($request, $rules);

        //Create the agenda
        $agenda = new Agenda;
        $agenda->title = $request->title;
        $agenda->admin_id = $user->id;
        $agenda->priority_high_color = $request->priority_high_color;
        $agenda->priority_medium_color = $request->priority_medium_color;
        $agenda->priority_low_color = $request->priority_low_color;

        $agenda->save();

        //Link user to agenda
        $agenda->users()->attach($user->id, [
            'add_task' => true,
            'edit_task' => true,
            'delete_task' => true,
            'edit_member' => true,
            'edit_calendar' => true,
            'delete_calendar' => true,
        ]);

        $agenda->save();

        return redirect()->route('calendar.show', ['calendarId' => $agenda->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($calendarId)
    {
        $agenda = Agenda::where('id', $calendarId)->first();
        $tasks = $agenda->tasks()->get();
        $users = $agenda->users()->get();


        //correlate currentUser with users from agenda to get necessary information to determine rights of user on calendar
        $currentUser = Auth::user();
        foreach ($users as $user)
            if ($user->id == $currentUser->id)
                $currentUser = $user;


        // set aside user rights for creation of tasks and edition of calendar
        $add_task = $currentUser->pivot->add_task;
        $edit_cal = $currentUser->pivot->edit_calendar;
        $edit_member = $currentUser->pivot->edit_member;

        $calendar = Calendar::addEvents([]);

        foreach ($tasks as $task) {
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
        $calendar->setOptions([
            'timeFormat' => 'H:mm' // uppercase H for 24-hour clock
        ]);

        return view('calendar', ['calendar' => $calendar,
            'calendarId' => $calendarId,
            'userRightsToEditMember' => $edit_member,
            'userRightsToAddTask' => $add_task,
            "userRightsToEditCal" => $edit_cal,
            'admin' => User::find($agenda->admin_id),
            'agenda' => $agenda,
            'members' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($calendarId)
    {
        $user = Auth::user();
        $agenda = Agenda::where('id', $calendarId)->first();
        $users = $agenda->users()->get();

        //correlate currentUser with users from agenda to get necessary information to determine rights of user on calendar
        $currentUser = Auth::user();
        foreach ($users as $user)
            if ($user->id == $currentUser->id)
                $currentUser = $user;

        $canDelete = $currentUser->pivot->delete_calendar;

        return view('handleCalendar', ['user' => $user, 'mode' => 'edit', 'agenda' => $agenda, 'canDelete' => $canDelete]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $calendarId)
    {
        $agenda = Agenda::find($calendarId);
        // create the validation rules ------------------------
        $rules = array(
            'title' => 'required|max:255|min:5',
            'priority_high_color' => 'required',
            'priority_medium_color' => 'required',
            'priority_low_color' => 'required',
        );

        $this->validate($request, $rules);
        $agenda->title = $request->title;
        $agenda->priority_low_color = $request->priority_low_color;
        $agenda->priority_medium_color = $request->priority_medium_color;
        $agenda->priority_high_color = $request->priority_high_color;

        $agenda->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($calendarId)
    {
        $agenda = Agenda::find($calendarId);
        $users = $agenda->users()->get();
        //correlate currentUser with users from agenda to get necessary information to determine rights of user on calendar
        $currentUser = Auth::user();
        foreach ($users as $user)
            if ($user->id == $currentUser->id)
                $currentUser = $user;
        Agenda::deleteAgendaWithRights($currentUser, $agenda);
        // suppresion du calendrier

        return redirect('/home');
    }

    public function editMember(Request $request, $calendarId)
    {
        $id = $this->getCalId($request);
        $editiontype = $request->request->get("update");
        $agenda = Agenda::find($calendarId);
        $user = User::where('email', $request->request->get('email'))->first();
        if($editiontype == 'add' && $user != null){
            $this->addMember($agenda,$user, $request->request);}
        if ($editiontype == 'delete')
            $this->deleteMember($agenda,$user);
        if ($editiontype == 'update')
            $this->updateMember($agenda,$user,$request);
        $users = $agenda->users()->get();
        return view('handleMember',['agenda'=>$agenda, 'users' => $users]);
    }
    private function deleteMember($agenda, $user)
    {
        // FIXME: pas jauli jauli.
        DB::table('agenda_user')->where(['user_id' => $user->id, 'agenda_id' => $agenda->id])->delete();
    }
    private function addMember($agenda, $user, $request){
        DB::table('agenda_user')->insert(
            ['add_task' => $request->get('add_task')!= null,
                'edit_task' =>$request->get('edit_task')!= null,
                'delete_task' => $request->get('delete_task')!= null,
                'edit_member' => $request->get('edit_member')!= null,
                'edit_calendar' => $request->get('edit_calendar')!= null,
                'delete_calendar' => $request->get('delete_calendar')!= null,
                'user_id' => $user->id,
                'agenda_id' => $agenda->id]
        );
    }

    private function updateMember($agenda, $user, $request){
        DB::table('agenda_user')->where(['user_id' => $user->id,'agenda_id' => $agenda->id])->update(
            ['add_task' => $request->get('add_task')!= null,
            'edit_task' =>$request->get('edit_task')!= null,
            'delete_task' => $request->get('delete_task')!= null,
            'edit_member' => $request->get('edit_member')!= null,
            'edit_calendar' => $request->get('edit_calendar')!= null,
            'delete_calendar' => $request->get('delete_calendar')!= null]);
    }
    public function indexMember(Request $request, $id)
    {
        // WTF!
        //$id = $this->getCalId($request);
        $agenda = Agenda::findOrFail($id);
        $users = $agenda->users()->get();
        return view('handleMember',['agenda'=>$agenda, 'users' => $users]);
    }

    /*
    private function getCalId($request)
    {
        $url = $request->url();
        preg_match_all('/\d+/', $url, $matches);
        return $matches[0][0];
    }
    */
}
