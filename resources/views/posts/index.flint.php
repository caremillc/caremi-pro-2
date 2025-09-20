@extends('layouts.app')

@section('header')
<h1 class="text-center">Posts</h1>
@endsection

@section('content')
<div class="container">
    <p>{{ $posts }}</p>

    <a href="{{ url('posts/create') }}" class="btn btn-primary">Create New Post</a>

    <!-- Example post list -->
    <ul class="list-group mt-3">
        <li class="list-group-item">Post 1</li>
        <li class="list-group-item">Post 2</li>
        <li class="list-group-item">Post 3</li>
    </ul>

    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
    @csrf
    @delete
    <button type="submit">Delete Post</button>
</form>

</div>
@endsection

@section('footer')
<p class="mb-0 text-center">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
@endsection

@push('scripts')
<script>
    console.log("Posts index page loaded!");
</script>
@endpush
