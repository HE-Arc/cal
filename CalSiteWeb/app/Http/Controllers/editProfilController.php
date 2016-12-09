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

        //Alias validation
        $aliasErrors = [];
        if($request->has('alias')){
            $alias = $request->alias;
            //Minimum size 4
            if(strlen($alias) < 4){
                $aliasErrors['lengthError'] = "Alias must be atleast 4 character long";
            }
            //contains only alphanumerical + _ chars
            if(!preg_match('/^[A-Za-z][A-Za-z0-9]*(?:_[A-Za-z0-9]+)*$/',$alias)){
                $aliasErrors['charError'] = "Alias must contains only alphanumerical characters and underscores";
            }

            if(empty($aliasErrors)){
                $user->alias = $alias;
            }
        }
        //Password validation
        $passwordErrors = [];
        if($request->has('password') && $request->has('password_confirmation')){
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;

            //Check confirmation
            if($password != $password_confirmation){
                $passwordErrors['confirmationError'] = "Password and confirmation don't match";
            }

            //Check size
            if(strlen($password) < 6){
                $passwordErrors['lengthError'] = "Password must be atleast 6 character long";
            }

            if(empty($passwordErrors)){
                $user->password = $password;
            }
        }
        $user->save();
        return view('editProfil', ['user' => $user, 'aliasErrors' => $aliasErrors, 'passwordErrors' => $passwordErrors]);
    }
}
