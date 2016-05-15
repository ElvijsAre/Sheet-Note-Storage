<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Music_categories;

class Music_categoriesController extends Controller
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
        $categories = Music_categories::orderBy('id', 'desc')->paginate(10);
        return view('music_categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('music_categories.create');
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
        ));
        // store data in DB
        $category = new Music_categories;
        
        $category->name = $request->name;
        
        $category->save();
        
        Session::flash('success', 'The category was succefully saved!');
        
        // redirect
        
        return redirect()->route('music.categories.show', $category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Music_categories::find($id);
        return view('music_categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Music_categories::find($id);
        //return the view ar mainigo, kurs satur info
        return view('music_categories.edit')->withCategory($category);
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
        ));
        
        $category = Music_categories::find($id);
        
        $category->name = $request->name;
        
        $category->save();
        
        Session::flash('success', 'The category was succefully updated!');
        
        // redirect
        
        return redirect()->route('music.categories.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Music_categories::find($id);
        
        $category->delete();
        
        Session::flash('success', 'The category was successfully deleted.');
        
       return redirect()->route('music.categories.index');
    }
}
