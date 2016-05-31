<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Security check if user is loged in, is admin and is not blocked
     */
    public function __construct() {
        $this->middleware (['auth', 'blocked', 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('categories.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        $category = new Category;
        
        $category->name = $request->name;
        
        $category->save();
        
        Session::flash('success', 'The category was succefully saved!');
        
        // redirect
        
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show')->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        //return the view ar mainigo, kurs satur info
        return view('categories.edit')->withCategory($category);
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
        
        $category = Category::find($id);
        
        $category->name = $request->name;
        
        $category->save();
        
        Session::flash('success', 'The category was succefully updated!');
        
        // redirect
        
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        $category->delete();
        
        Session::flash('success', 'The category was successfully deleted.');
        
       return redirect()->route('categories.index');
    }
}
