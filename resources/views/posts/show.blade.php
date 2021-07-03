@extends('layouts.default')

@section('content')
    <a href="{{ route('posts.index') }}">Indietro</a>
    <h1>{{ $post->title }}</h1>
    <h6>{{ $post->category->name }}</h6>
    <p>{{ $post->content }}</p>
    <p>{{ $post->created_at }}</p>
    @auth
        <a href="{{ route('admin.posts.edit', ['slug' => $post->slug]) }}">Modifica</a><br>
        <form action="{{ route('admin.posts.destroy', ['slug' => $post->slug]) }}" method="post">
            @csrf

            @method('DELETE')

            <input type="submit" value="Elimina">
        </form>
    @endauth
@endsection
