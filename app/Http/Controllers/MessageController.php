<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Message;
use App\User;

class MessageController extends Controller
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
        $messages = Message::orderBy('id', 'desc')->where('recipient_id', '=' , Auth::user()->id)
                ->Where('is_deleted_recipient', '=' , 0)
                ->orWhere('sender_id', '=' , Auth::user()->id)
                ->Where('is_deleted_sender', '=' , 0)
                ->paginate(10);
        return view('messages.index')->withMessages($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('messages.create', compact('users'));
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
            'title' => 'required|max:255',
            'body' => 'required'
        ));
        // store data in DB
        $message = new Message;
        
        $message->sender_id = Auth::user()->id;
        $message->recipient_id = $request->recipient;
        $message->title = $request->title;
        $message->body = $request->body;
        
        $message->save();
        
        Session::flash('success', 'Message was successfully sent!');
        
        // redirect
        
        return redirect()->route('messages.show', $message->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        return view('messages.show')->withMessage($message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get message from DB, save it as variable
        $message = Message::find($id);
        //return the view with viraiable
        return view('messages.edit')->withMessage($message);
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
        
        $message = Message::find($id);
        if (Auth::user()->id == $message->sender_id && Auth::user()->id == $message->recipient_id)
            {
            $message->is_deleted_sender = 1;
            $message->is_deleted_recipient = 1;

            $message->save();

            // set flash data with success ,essage

            Session::flash('success', 'This message was succesfully deleted!');

            // redirect with flash datta to posts.show
            return redirect()->route('messages.index');
            }
        if (Auth::user()->id == $message->sender_id)
            {
            $message->is_deleted_sender = 1;

            $message->save();

            // set flash data ar success messsage

            Session::flash('success', 'This message was succesfully deleted!');

            // redirect with flash datta to posts.show
            return redirect()->route('messages.index');
            }
        // If admin  
        if (Auth::user()->id == $message->recipient_id)
            {
            $message->is_deleted_recipient = 1;

            $message->save();

            // set flash data ar success messsage

            Session::flash('success', 'This message was succesfully deleted!');

            // redirect with flash datta to posts.show
            return redirect()->route('messages.index');
            }
        // If use not admin or author
        else 
            {
            Session::flash('failed', "You aren't the messages sender or recipient!");
            return redirect()->route('messages.index');
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
        //
    }
}
