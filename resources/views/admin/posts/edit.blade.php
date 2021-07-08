@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.posts.update', ['slug' => $post->slug]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        <br><br>
        <label for="category_id">Category</label><br>
        <select name="category_id" id="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <br><br>
        <div class="tags-container">
            @foreach($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                    {{$tag->name}}
                </label>
            @endforeach
        </div>
        <br>
        <label for="title">Content</label><br>
        <textarea rows="10" cols="80" name="content" id="content">{{ old('content', $post->content) }}</textarea>
        <br>
        <label for="">Copertina</label><br>
        <input type="file" name="postCover" accept=".jpg,.png">
        <br><br>
        <input type="submit" value="Conferma">
    </form>
    <a href="{{ route('posts.index') }}">Indietro</a>
@endsection
