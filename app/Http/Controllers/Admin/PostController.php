<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

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
        $data = [
            "categories" => Category::all(),
            "tags" => Tag::all()
        ];

        return view("admin.posts.create", $data);
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

        if(!key_exists("tags", $data)) {
            $newPost["tags"] = [];
        }

        if(key_exists("postCover", $data)) {
            $newPost->cover_url = Storage::put("postCovers", $data["postCover"]);
        }
        
        $newPost->save();
        $newPost->tags()->sync($data["tags"]);
        
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
            "post" => $post,
            "categories" => Category::all(),
            "tags" => Tag::all()
        ];

        return view("admin.posts.edit", $data);
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

        if(key_exists("tags", $data)) {
            $post->tags()->sync($data["tags"]);
        }

        if(key_exists("postCover", $data)) {
            if ($post->cover_url) {
                Storage::delete($post->cover_url);
            }

            $post->cover_url = Storage::put("postCovers", $data["postCover"]);
        } else {
            Storage::delete($post->cover_url);
            $post->cover_url = NULL;
        }

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

        $post->tags()->detach();

        $post->delete();

        return redirect()->route("posts.index");
    }
}
