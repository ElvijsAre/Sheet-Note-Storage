<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dabū mainīgo no datubāzes ar visiem postiem
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        //parādīt mainīgo ar visiem postiem
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timestamp = time();
        $url = str_slug($request->title ,"_");
        $slug = $timestamp . "" . $url;
        
        
        // validation of data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // store data in DB
        $post = new Post;
        
        $post->title = $request->title;
        $post->slug = $slug;
        $post->body = $request->body;
        
        $post->save();
        
        Session::flash('success', 'The post was succefully saved!');
        
        // redirect
        
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
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
        $post = Post::find($id);
        //return the view ar mainigo, kurs satur info
        return view('posts.edit')->withPost($post);
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
        $timestamp = time();
        $url = str_slug($request->title ,"_");
        $slug = $timestamp . "" . $url;
        
        // Validate datus
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // Saglabat datus
        $post = Post::find($id);
        
        $post->title = $request->input('title');
        $post->slug = $slug;
        $post->body = $request->input('body');
        // Laiks tiks updatots automatiski
        
        $post->save();
        
        // set flash data are success zinu
        
        Session::flash('success', 'This post was succesfully saved.');                
        
        // refirect ar flast datiem uz posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        $post->delete();
        
        Session::flash('success', 'The post was successfully deleted.');
        
        return redirect()->route('posts.index');
    }
}
