<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\EventModel;

class CalendarController extends Controller {

    public function index()
    {
        $staticEvent = \Calendar::event(
            'Today\'s Sample',
            true,
            new \DateTime('2016-12-07'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2016-12-08'), //end time (you can also use Carbon instead of DateTime)
            null,
            [
                'color' => '#0F0',
                'url' => 'http://google.com',
            ]
        );
        $calendar = \Calendar::addEvent($staticEvent);

        return view('calendar', compact('calendar'));
    }

}
