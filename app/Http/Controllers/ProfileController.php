<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

class ProfileController extends Controller
{
    //Security check if user is loged in and is not blocked.
    public function __construct() {
        $this->middleware (['auth', 'blocked']);
    }
    //Get users Data
    public function getShow($id) 
    {
        $user = User::find($id);
        return view('profile.show')->withUser($user);
    }
    
    //Get edit form
    public function getEdit($id)
    {
        $user = User::find($id);
        return view('profile.edit')->withUser($user);
    }
    
    public function postUpdate(Request $request, $id)
    {      
        // Validate data
        $user = User::find($id);
        if($request->input('email') == $user->email)
        {
            $this->validate($request, array(
                'name' => 'required|max:255',
                'age' => 'Integer|max:120|min:0',
                'birth_date' => 'Date|after:01.01.1900|before:today|',
            ));
        }
        else
        {
            $this->validate($request, array(
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'age' => 'Integer|max:120|min:0',
                'birth_date' => 'Date|after:01.01.1900|before:today|',
            ));        
        }
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->birth_date = $request->input('birth_date');
        $user->gender = $request->input('gender');
        $user->country_id = $request->input('country');

        $user->save();


        Session::flash('success', 'User was succesfully saved.');

        return redirect()->route('profile', $user->id);
        
    }
    

}
