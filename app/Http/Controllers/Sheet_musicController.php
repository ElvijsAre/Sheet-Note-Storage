<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Sheet_music;
use App\Music_author;
use App\Music_categories;
use App\Music_orchestation;
use App\User;

class Sheet_musicController extends Controller
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
        $sheets = Sheet_music::orderBy('id', 'desc')->paginate(10);
        return view('music_sheets.index')->withSheets($sheets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Music_categories::lists('name');
        $authors = Music_author::lists('name');
        return view('music_sheets.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->input('categories'), $request->input('authors'));
        // validation of data
        $this->validate($request, array(
            'title' => 'required|max:255',
        ));
        // store data in DB
        $sheet = new sheet_music;
        
        $sheet->title = $request->title;
        $sheet->user_id = Auth::user()->id;
        
        $sheet->save();
        
        $sheet->music_categories()->attach($request->categories);
        $sheet->music_author()->attach($request->authors);
        
        $sheet->save();
              
        Session::flash('success', 'Musical succesfully added!');
        
        // redirect
        
        return redirect()->route('music.sheets.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sheet = sheet_music::find($id);
        return view('music_sheets.show')->withSheet($sheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sheet = sheet_music::find($id);
        return view('music_sheets.edit')->withSheet($sheet);
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
            'title' => 'required|max:255',
        ));
        // store data in DB
        $sheet = sheet_music::find($id);
        
        $sheet->title = $request->title;
        $sheet->user_id = Auth::user()->id;
        
        $sheet->save();
        
        $sheet->music_categories()->attach($request->categories);
        $sheet->music_author()->attach($request->authors);
        
        $sheet->save();
        
        Session::flash('success', 'Musical was succesfully updated!');
        
        // redirect
        
        return redirect()->route('music.sheets.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->is_admin == 1) {
            $sheet = sheet_music::find($id);
            $sheet->delete();

            Session::flash('success', 'The Musical was successfully deleted.');

            return redirect()->route('music.sheets.index');
        } else {
            Session::flash('failed', 'Only admins can delete Musicals!');
            return redirect()->route('music.authors.index');
        }
    }
    /**
     * Allows to download files
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($file_name) 
    {
        $file_path = storage_path('app/public/files/'.$file_name);
        return response()->download($file_path);
    }
}
