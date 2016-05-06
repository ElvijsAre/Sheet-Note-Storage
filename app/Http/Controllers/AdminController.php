<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware ('blocked');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dabū mainīgo no datubāzes ar visiem postiem
        $users = User::orderBy('id', 'desc')->paginate(10);
        //parādīt mainīgo ar visiem postiem
        return view('admins.index')->withUsers($users);
        //->where(Auth::user()->id = $posts->user_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admins.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dabut postu no datubazes un saglabat ka mainigo
        $user = User::find($id);
        //return the view ar mainigo, kurs satur info
        return view('admins.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        // Validate datus
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
        // Saglabat datus
        // Parbaude vai postu edito tā autors
        $user = User::find($id);
        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->birth_date = $request->input('birth_date');
        $user->gender = $request->input('gender');
        $user->country_id = $request->input('country');
        $user->is_blocked = $request->input('is_blocked');
        $user->is_admin = $request->input('is_admin');
        // Laiks tiks updatots automatiski

        $user->save();

        // set flash data are success zinu

        Session::flash('success', 'User was succesfully saved.');

        // refirect ar flast datiem uz posts.show
        return redirect()->route('admin.show', $user->id);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
