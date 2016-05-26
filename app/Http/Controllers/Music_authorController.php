<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Country;
use App\Music_author;

class Music_authorController extends Controller
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
        //dabū mainīgo no datubāzes ar visiem ierakstiem
        $authors = Music_author::orderBy('id', 'desc')->paginate(10);
        
        return view('authors.index')->withAuthors($authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('authors.create')->withCountries($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        // validation of data
        $this->validate($request, array(
            'name' => 'required|max:255',
            'age' => 'Integer|max:120|min:0',
            'birth_date' => 'Date|before:today|',
            'death_date' => 'Date|before:today|after:birth_date',
        ));
        // store data in DB
        $author = new music_author;
        
        $author->name = $request->name;
        $author->country_id = $request->country;
        $author->age = $request->age;
        $author->birth_date = $request->birth_date;
        $author->death_date = $request->death_date;
        $author->gender = $request->gender;
        $author->user_id = Auth::user()->id;
        
        $author->save();
        
        Session::flash('success', 'Author was succesfully added!');
        
        // redirect
        
        return redirect()->route('music.authors.show', $author->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Music_author::find($id);
        return view('authors.show')->withAuthor($author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Music_author::find($id);
        return view('authors.edit')->withAuthor($author);
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
        // validation of data
        $this->validate($request, array(
            'name' => 'required|max:255',
            'age' => 'Integer|max:120|min:0',
            'birth_date' => 'Date|before:today|',
            'death_date' => 'Date|before:today|after:birth_date',
        ));
        // store data in DB
        $author = Music_author::find($id);
        
        $author->name = $request->input('name');
        $author->country_id = $request->country;
        $author->age = $request->input('age');
        $author->birth_date = $request->input('birth_date');
        $author->death_date = $request->input('death_date');
        $author->gender = $request->input('gender');
        $author->user_id = Auth::user()->id;
        
        $author->save();
        
        Session::flash('success', 'Author was succesfully updated!');
        
        // redirect
        
        return redirect()->route('music.authors.show', $author->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Music_author::find($id);
        $author->delete();
        
        Session::flash('success', 'Author was successfully deleted!');
        
        return redirect()->route('music.authors.index');
    }
}
