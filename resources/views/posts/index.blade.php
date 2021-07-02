@extends('layouts.app')

@section('content')

<div class="container-flex vertical">
    @foreach($posts as $post)
        <div class="item">
            <h1>{{$post->title}}</h1>
            <p>{{$post->content}}</p>
            <a href="{{route("posts.show", ["slug" => $post->slug])}}">Apri</a>
        </div>
    @endforeach
</div>

@endsection