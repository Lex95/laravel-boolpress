@extends('layouts.default')

@section('content')
    <a href="{{route("posts.index")}}">Indietro</a>
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <p>{{$post->created_at}}</p>
@endsection