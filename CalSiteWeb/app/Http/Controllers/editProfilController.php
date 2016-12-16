<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editProfilController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('editProfil', ['user' => $user]);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();

        // create the validation rules ------------------------
        $rules = array(
            'alias' => 'required|max:255|min:3',
            'password' => 'min:6|confirmed',
        );

        $this->validate($request, $rules);

        $user->alias = $request->alias;

        if($request->has('password'))
            $user->password = $request->password;

        $user->save();
        return view('editProfil', ['user' => $user]);

    }
}
