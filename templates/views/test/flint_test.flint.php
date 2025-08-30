@extends('layouts.app')

@section('title')
Flint Engine Test
@endsection

@section('main')
<h1>Flint Engine Test</h1>

<p>Normal variable: {{ $name }}</p>
<p>Raw output: {!! $rawHtml !!}</p>

<form method="POST" action="/submit">
    @csrf
    <label>Email</label>
    <input type="email" name="email">
    @error('email')

    <label>Password</label>
    <input type="password" name="password">
    @error('password')

    <button type="submit">Submit</button>
</form>

@auth
<p>Authenticated user: {{ $user->name ?? 'Unknown' }}</p>
@endauth

@guest
<p>You are a guest.</p>
@endguest

@if($showMessage)
    <p>If statement works!</p>
@elseif(!$showMessage)
    <p>Elseif works!</p>
@else
    <p>Else works!</p>
@endif

@foreach($items as $item)
    <p>Item: {{ $item }}</p>
@endforeach

@for($i = 1; $i <= 3; $i++)
    <p>For loop iteration: {{ $i }}</p>
@endfor

@while($counter > 0)
    <p>While loop counter: {{ $counter }}</p>
    @php $counter--; @endphp
@endwhile

@switch($status)
    @case('success')
        <p>Status is success</p>
        @break
    @case('error')
        <p>Status is error</p>
        @break
    @default
        <p>Status unknown</p>
@endswitch

@endsection

@push('scripts')
@verbatim
<script>
    console.log("This script should appear in the @stack('scripts') section.");
</script>
@endverbatim
@endpush
