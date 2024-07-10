<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $posts = Post::all();
        $latestPost = Post::latest()->first();
    
        return view('home', [
            'posts' => $posts,
            'latestPost' => $latestPost,
        ]);
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        return view('post', ['post' => $post]);
    }
}
