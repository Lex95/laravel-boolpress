@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.posts.update', ['slug' => $post->slug]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}">
        <br>
        <label for="category_id">Category</label><br>
        <select name="category_id" id="category_id">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <br>
        <label for="title">Content</label><br>
        <textarea rows="10" name="content" id="content">{{ old('content', $post->content) }}</textarea>
        <br>
        <input type="submit" value="Conferma">
    </form>
    <a href="{{ route('posts.index') }}">Indietro</a>
@endsection
