@extends('layouts.default')

@section('content')
    <form action="{{ route('send') }}" method="post">
        @csrf
        <label for="content">Content</label><br>
        <textarea rows="10" cols="80" name="content" id="content"></textarea>
        <br>
        <input type="submit" value="Conferma">
    </form>
    <a href="{{ route('posts.index') }}">Indietro</a>
@endsection
