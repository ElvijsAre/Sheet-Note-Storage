<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Session;

class PostController extends Controller
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
        //dabū mainīgo no datubāzes ar visiem postiem
        if(Auth::user()->is_admin == 1)
        {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
        }
        else
        {
            $posts = Post::orderBy('id', 'desc')->where('user_id', '=' , Auth::user()->id)->paginate(10);
        }
        //$posts = Post::orderBy('id', 'desc')->where('user_id', '=' , Auth::user()->id)->paginate(10);
        //parādīt mainīgo ar visiem postiem
        return view('posts.index')->withPosts($posts);
        //->where(Auth::user()->id = $posts->user_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
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
        $slug = $timestamp . "_" . $url;
        
        
        // validation of data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // store data in DB
        $post = new Post;
        
        $post->title = $request->title;
        $post->category_id = $request->category;
        $post->slug = $slug;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        
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
        $slug = $timestamp . "_" . $url;
        
        // Validate datus
        $this->validate($request, array(
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // Saglabat datus
        // Parbaude vai postu edito tā autors
        $post = Post::find($id);
        if (Auth::user()->id == $post->user_id)
            {
            $post->category_id = $request->category;
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
        // Ja ir admins    
        if (Auth::user()->is_admin == 1)
            {
            $post->category_id = $request->category;
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
        // kļūdas paziņojums, ja nav posta autors vai admins
        else 
            {
            Session::flash('failed', "This post was NOT succesfully saved, because you aren't the author!");
            return redirect()->route('posts.index');
            }
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
        if (Auth::user()->id == $post->user_id)
            {
            $post->delete();
        
            Session::flash('success', 'The post was successfully deleted.');
        
            return redirect()->route('posts.index');
            }
        if (Auth::user()->is_admin == 1)
            {
            $post->delete();
        
            Session::flash('success', 'The post was successfully deleted.');
        
            return redirect()->route('posts.index');
            }
        else
            {
            Session::flash('failed', "This post was NOT deleted, because you aren't the author!");
            return redirect()->route('posts.index');
            }
        
    }
}
