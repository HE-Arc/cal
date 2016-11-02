<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MyController extends Controller {

    public function index($param = 'cyril')
    {
        return view('custview')->with('param', $param);
    }

}