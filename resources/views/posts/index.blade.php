@extends('layouts.app')

@section('content')

    <div class="container-flex vertical">
        @auth
            <div>
                <a href="{{ route('admin.posts.create')}}">Crea un nuovo Post</a>
            </div>
        @endauth
        @foreach ($posts as $post)
            <div class="item">
                <h1>{{ $post->title }}</h1>
                <h6>{{ $post->category->name }}</h6>
                <p>{{ $post->content }}</p>
                <div class="container-flex">
                    <a href="{{ route('posts.show', ['slug' => $post->slug]) }}">Apri</a>
                    @auth
                        <div class="filler"></div>
                        <a href="{{ route('admin.posts.edit', ['slug' => $post->slug]) }}">Modifica</a>
                        <form action="{{ route('admin.posts.destroy', ['slug' => $post->slug]) }}" method="post">
                            @csrf

                            @method('DELETE')

                            <input type="submit" value="Elimina">
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>

@endsection
