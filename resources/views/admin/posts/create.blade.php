@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        <label for="title">Title</label><br>
        <input type="text" name="title" id="title">
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
                <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                <label for="tags[]">{{$tag->name}}</label>
            @endforeach
        </div>
        <br><br>
        <label for="title">Content</label><br>
        <textarea rows="10" cols="80" name="content" id="content"></textarea>
        <br>
        <input type="submit" value="Conferma">
    </form>
    <a href="{{ route('posts.index') }}">Indietro</a>
@endsection