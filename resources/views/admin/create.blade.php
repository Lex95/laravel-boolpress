@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <br>
        <label for="title">Content</label>
        <textarea rows="10" name="content" id="content">
        <br>
        <input type="submit" value="Conferma">
    </form>
    <a href="{{ route('posts.index') }}">Indietro</a>
@endsection