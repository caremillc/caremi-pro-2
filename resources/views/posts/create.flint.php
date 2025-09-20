@extends('layouts.app')

@section('title')
    My Posts
@endsection

@section('content')
    @auth
        <p>Welcome, {{ auth()->name }}!</p>
    @endauth

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="title" value="{{ old('title') }}">
        <button type="submit">Create Post</button>
    </form>

    <a href="{{ asset('css/app.css') }}">App CSS</a>
@endsection
