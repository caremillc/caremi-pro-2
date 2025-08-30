@extends('layouts.app')

@section('title')
Login
@endsection

@section('main')
<form method="POST" action="/login">
    @csrf

    <label>Email</label>
    <input type="email" name="email" />
    @error('email')

    <label>Password</label>
    <input type="password" name="password" />
    @error('password')

    <button type="submit">Login</button>
</form>

@auth
<p>Welcome back, {{ $user->name }}!</p>
@endauth

@guest
<p>Please log in.</p>
@endguest
@endsection

@push('scripts')
@verbatim
<script>
    console.log("Login page loaded!");
</script>
@endverbatim
@endpush
