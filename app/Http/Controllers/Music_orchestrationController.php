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
            'file' => 'required',
        ));
        // store data in DB
        
        $note = new music_orchestration;
        $files = $request->file('file');
        if ($files)
        {
            foreach ($files as $file):
                $note->sheet_music_id = $request->musical;
                $filename = $request->file_name. '.jpg';
                $note->file_name = $filename;
                Storage::put("public/files/$filename", file_get_contents($file));
                $note->save();
            endforeach;
            Session::flash('success', 'Musical succesfully added!');
        
            // redirect
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
