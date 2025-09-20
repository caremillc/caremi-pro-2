@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('header')
<nav class="nav justify-content-center">
    <a class="nav-link" href="/">Home</a>
    <a class="nav-link" href="/about">About</a>
    <a class="nav-link" href="/contact">Contact</a>
</nav>
@endsection

@section('nav')
<nav class="navbar navbar-light bg-light mb-4">
    <h2>Navigation Section</h2>
</nav>
@endsection

@section('content')
<div class="text-center">
    <h1>{{ $title }}</h1>
    <p>{{ $message }}</p>
</div>
@endsection

@section('footer')
<p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
@endsection

@push('scripts')
<script src="{{ asset('js/scripts.js') }}"></script>

@once('home-inline-script')
<script>
    console.log("One-time inline script for Home page loaded!");
</script>
@endonce
@endpush
