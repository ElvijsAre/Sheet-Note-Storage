<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {
    
    /**
     * Displays home page with newest 5 forum posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }
}