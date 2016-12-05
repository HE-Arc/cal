<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CalendarController extends Controller {

    public function index()
    {
        return view('calendar');
    }

}