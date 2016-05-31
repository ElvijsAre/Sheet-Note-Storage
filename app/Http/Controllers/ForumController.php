<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Comment;
use App\Category;

class ForumController extends Controller
{
    public function getIndex() {
        //Return all categories with posts tied to them.
        $categories = Category::with('posts')->get();
        return view('forum.index', compact('categories'));
    }
    
    public function getSingle($slug){
        // Get Url from DB to show single post
        $post = Post::where('slug', '=', $slug)->with('comments')->first();
        
        //return viewe with post
        return view('forum.single')->withPost($post);
    }
}
