<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Post;
use App\User;
use Session;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dabū mainīgo no datubāzes ar visiem postiem
        $comments = Comment::orderBy('id', 'desc')->where('user_id', '=' , Auth::user()->id)->paginate(10);
        //parādīt mainīgo ar visiem postiem
        return view('comments.index')->withComments($comments);
        //with('comments',$comments);
        //withCommments($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comments.create');
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
            'body' => 'required',
        ));
        
        $comment = new Comment;
        
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post;
        
        $comment->save();
        
        Session::flash('success', 'The comment was succefully saved!');
        
        // redirect
        
        return redirect()->route('comments.show', $comment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show')->withComment($comment);
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
        $comment = Comment::find($id);
        //return the view ar mainigo, kurs satur info
        return view('comments.edit')->withComment($comment);
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
            'body' => 'required',
        ));
        
        $comment = Comment::find($id);
        if (Auth::user()->id == $comment->user_id)
            {
            $comment->body = $request->body;
            $comment->save();
            Session::flash('success', 'The comment was succefully updated!');
            // redirect
            return redirect()->route('comments.show', $comment->id);
            }
        else 
            {
            Session::flash('failed', "This comment was NOT succesfully saved, because you aren't the author");
            return redirect()->route('comments.index');
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
        $comment = Comment::find($id);
        
        $comment->delete();
        
        Session::flash('success', 'The comment was successfully deleted!');
        
        return redirect()->route('comments.index');
    }
}
