<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "posts" => Post::all()
        ];
        return view("posts.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|max:255",
            "content" => "required|max:255"
        ]);

        $data = $request->all();
        $newPost = new Post;
        $newPost->fill($data);
        $newPost->slug = Str::slug($request->title);
        $newPost->save();

        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where("slug", $slug)->first();

        if(!$post) {
            abort(404);
        }
        
        $data = [
            "post" => $post
        ];

        return view("posts.show", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where("slug", $slug)->first();

        if(!$post) {
            abort(404);
        }
        
        $data = [
            "post" => $post
        ];

        return view("admin.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            "title" => "required|max:255",
            "content" => "required|max:255"
        ]);

        $data = $request->all();
        $post = Post::where("slug", $slug)->first();
        $post->update($data);

        return redirect()->route("posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where("slug", $slug)->first();

        $post->delete();

        return redirect()->route("posts.index");
    }
}
