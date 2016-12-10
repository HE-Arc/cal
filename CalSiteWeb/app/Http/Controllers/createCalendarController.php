<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Agenda;

class createCalendarController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('createCalendar', ['user' => $user]);
    }

    public function create(Request $request)
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
}
