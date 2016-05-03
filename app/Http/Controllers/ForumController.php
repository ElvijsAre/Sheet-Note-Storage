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
        //$posts = Post::orderBy('category_id', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::with('posts')->get();
        return view('forum.index', compact('categories'));
    }
    
    public function getSingle($slug){
        // dabūt no DB izmantojot slug
        $post = Post::where('slug', '=', $slug)->with('comments')->first();
        
        //return viewe ar postu
        return view('forum.single')->withPost($post);
    }
}
