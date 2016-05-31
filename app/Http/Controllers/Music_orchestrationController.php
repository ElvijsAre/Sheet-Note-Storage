<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Sheet_music;
use App\Music_author;
use App\Music_categories;
use App\Music_orchestration;
use App\User;

use App\Http\Requests;

class Music_orchestrationController extends Controller
{
    //Security check if user is loged in and is not blocked.
    public function __construct() {
        $this->middleware (['auth', 'blocked']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musicals = Music_orchestration::orderBy('id', 'desc')->paginate(10);
        return view('music_orchestrations.index')->withMusicals($musicals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $musicals = Sheet_music::lists('title');
        return view('music_orchestrations.create', compact('musicals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'file_name' => 'required|max:255',
        ));
        // store data in DB
        
        $musicals = new music_orchestration;
        if ($file = $request->file('file'))
        {
            $musicals->sheet_music_id = $request->musical;
            $filename = $request->file_name. '.jpg';
            $musicals->file_name = $filename;
            Storage::put("public/files/$filename", file_get_contents($file));
            $musicals->save();
            Session::flash('success', 'Musical succesfully added!');
        
            // redirect
        
            return redirect()->route('music.orchestrations.index');
        }
        else
        {
            Session::flash('failed', 'No File Found!');
            return redirect()->route('music.orchestrations.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $musical = Music_orchestration::find($id);
        return view('music_orchestrations.show')->withMusical($musical);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $musical = Music_orchestration::find($id);
        return view('music_orchestrations.edit')->withMusical($musical);
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
        $this->validate($request, array(
            'file_name' => 'required|max:255',
        ));
        // store data in DB
        
        $musical = Music_orchestration::find($id);
        
            $musical->sheet_music_id = $request->musical;
            $filenameold = $musical->file_name;
            $filename = $request->file_name;
            $musical->file_name = $filename;
            Storage::move("public/files/$filenameold", "public/files/$filename");
            $musical->save();
            Session::flash('success', 'Musical succesfully updated!');
        
            // redirect
        
            return redirect()->route('music.orchestrations.index');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::user()->is_admin == 1) 
        {
            $musical = Music_orchestration::find($id);
            $filename = $musical->file_name;
            Storage::delete("public/files/$filename");
            $musical->delete();
            Session::flash('success', 'Musical succesfully deleted!');
            return redirect()->route('music.orchestrations.index');
        }
        else
        {
            Session::flash('failed', 'Only admins can delete Notes!');
            return redirect()->route('music.orchestrations.index'); 
        }

    }
}
