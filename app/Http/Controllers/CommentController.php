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
    /**
     * Security check if user is loged in and is not blocked
     */
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
        //Check if user is admin, if yes user recieves all data, if no only users owne data.
        if(Auth::user()->is_admin == 1)
        {
            $comments = Comment::orderBy('id', 'desc')->paginate(10);
        }
        else
        {
            $comments = Comment::orderBy('id', 'desc')->where('user_id', '=' , Auth::user()->id)->paginate(10);
        }
        //Returns a viewe with a variable.
        return view('comments.index')->withComments($comments);
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
        // If user is author
        if (Auth::user()->id == $comment->user_id)
            {
            $comment->body = $request->body;
            $comment->save();
            Session::flash('success', 'The comment was succefully updated!');
            // redirect
            return redirect()->route('comments.show', $comment->id);
            }
        // If user is admin 
        if (Auth::user()->is_admin == 1)
            {
            $comment->body = $request->body;

            $comment->save();

            // set flash data with success message

            Session::flash('success', 'The comment was succefully updated!');

            // redirect to show route with sucess message
            return redirect()->route('comments.show', $comment->id);
            }
        // If user is not admin or author     
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
        // If user is author
        if (Auth::user()->id == $comment->user_id)
            {
            $comment->delete();
        
            Session::flash('success', 'The comment was successfully deleted!');
        
            return redirect()->route('comments.index');
            }
        // If user is admin
        if (Auth::user()->is_admin == 1)
            {
            $comment->delete();
        
            Session::flash('success', 'The comment was successfully deleted!');
        
            return redirect()->route('comments.index');
            }
        // If useer is not admin or author
        else
            {
            Session::flash('failed', "This comment was NOT deleted, because you aren't the author!");
            return redirect()->route('comments.index');
            }      
    }
}
