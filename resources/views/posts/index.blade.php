@extends('layouts.app')

@section('content')

    <div class="container-flex vertical">
        @foreach ($posts as $post)
            <div class="item">
                <h1>{{ $post->title }}</h1>
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
