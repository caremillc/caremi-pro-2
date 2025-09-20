@extends('layouts.app')

@section('header')
<h1 class="text-center">Post Details</h1>
@endsection

@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            {!! $postId !!}
        </div>
    </div>

    <a href="{{ url('posts') }}" class="btn btn-secondary">Back to Posts</a>
</div>
@endsection

@section('footer')
<p class="mb-0 text-center">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
@endsection
