<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate()
        ]);
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'slug' => 'required |unique:posts,slug,' . $post->id,
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imagePath = '/images/' . $name;
        } else {
            $imagePath = $post->image;
        }

        $post->update([
           'image' => $imagePath, 
           'title' => $request->title,
           'slug' => $request->slug,
           'body' => $request->body
        ]);

        return redirect()->route('posts.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'slug' => 'required |unique:posts,slug',
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imagePath = '/images/' . $name;
        } else {
            $imagePath = null;
        }

        $post = $request->user()->posts()->create([
           'image' => $imagePath, 
           'title' => $request->title,
           'slug' => $request->slug,
           'body' => $request->body
        ]);

        event(new PostCreated($post));

        return redirect()->route('posts.index');
    }

    
    public function create(Post $post)
    {
        return view('posts.create', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

}
